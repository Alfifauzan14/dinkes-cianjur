<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\GaleriPhoto;
use App\Models\Kategori;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::with('thumbnail')->withCount('photos');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $galeris = $query->orderBy('created_at', 'desc')->paginate(10);
        $kategoris = Kategori::ofType('galeri')->orderBy('nama')->get();

        return view('admin.galeri.index', compact('galeris', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::ofType('galeri')->orderBy('nama')->get();

        return view('admin.galeri.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
            'thumbnail_index' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $galeri = Galeri::create([
                'title' => $request->input('title'),
                'category' => $request->input('category'),
            ]);

            $images = $request->file('images');
            $thumbnailIndex = (int) $request->input('thumbnail_index', 0);
            $destinationPath = public_path('uploads/galeri');

            foreach ($images as $index => $image) {
                $imageName = ImageService::compressAndUpload($image, $destinationPath, 1920, 82);

                GaleriPhoto::create([
                    'galeri_id' => $galeri->id,
                    'image' => $imageName,
                    'is_thumbnail' => $index === $thumbnailIndex,
                    'order' => $index,
                ]);
            }
        });

        return redirect()->route('admin.galeri.index')->with('success', 'Album galeri berhasil ditambahkan!');
    }

    public function edit(Galeri $galeri)
    {
        $galeri->load('photos');
        $kategoris = Kategori::ofType('galeri')->orderBy('nama')->get();

        return view('admin.galeri.edit', compact('galeri', 'kategoris'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        if ($request->has('remove_photos')) {
            $removePhotos = $request->input('remove_photos');
            if (is_string($removePhotos)) {
                $trimmed = trim($removePhotos);
                $ids = $trimmed !== '' ? array_filter(array_map('trim', explode(',', $trimmed)), 'strlen') : [];
                $request->merge(['remove_photos' => ! empty($ids) ? array_map('intval', $ids) : null]);
            }
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:10240',
            'thumbnail_index' => 'nullable|integer|min:0',
            'remove_photos' => 'nullable|array',
            'remove_photos.*' => 'integer',
        ]);

        DB::transaction(function () use ($request, $galeri) {
            $galeri->update([
                'title' => $request->input('title'),
                'category' => $request->input('category'),
            ]);

            // Remove selected photos
            $removeIds = $request->input('remove_photos', []);
            if (! empty($removeIds)) {
                $photosToRemove = $galeri->photos()->whereIn('id', $removeIds)->get();
                foreach ($photosToRemove as $photo) {
                    $path = public_path('uploads/galeri/'.$photo->image);
                    if (File::exists($path)) {
                        File::delete($path);
                    }
                    $photo->delete();
                }
            }

            // Upload new photos
            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $destinationPath = public_path('uploads/galeri');

                $existingCount = $galeri->photos()->count();
                foreach ($images as $index => $image) {
                    $imageName = ImageService::compressAndUpload($image, $destinationPath, 1920, 82);

                    GaleriPhoto::create([
                        'galeri_id' => $galeri->id,
                        'image' => $imageName,
                        'is_thumbnail' => false,
                        'order' => $existingCount + $index,
                    ]);
                }
            }

            // Handle thumbnail selection
            $thumbnailIndex = $request->input('thumbnail_index');
            if ($thumbnailIndex !== null) {
                $galeri->photos()->update(['is_thumbnail' => false]);

                // thumbnail_index 0 = first photo in current list
                $allPhotos = $galeri->photos()->orderBy('order')->get();
                if (isset($allPhotos[(int) $thumbnailIndex])) {
                    $allPhotos[(int) $thumbnailIndex]->update(['is_thumbnail' => true]);
                }
            }

            // If no thumbnail set yet, set first photo as thumbnail
            $hasThumbnail = $galeri->photos()->where('is_thumbnail', true)->exists();
            if (! $hasThumbnail) {
                $firstPhoto = $galeri->photos()->orderBy('order')->first();
                if ($firstPhoto) {
                    $firstPhoto->update(['is_thumbnail' => true]);
                }
            }
        });

        return redirect()->route('admin.galeri.index')->with('success', 'Album galeri berhasil diperbarui!');
    }

    public function destroy(Galeri $galeri)
    {
        DB::transaction(function () use ($galeri) {
            foreach ($galeri->photos as $photo) {
                $path = public_path('uploads/galeri/'.$photo->image);
                if (File::exists($path)) {
                    File::delete($path);
                }
            }
            $galeri->photos()->delete();
            $galeri->delete();
        });

        return redirect()->route('admin.galeri.index')->with('success', 'Album galeri berhasil dihapus!');
    }

    public function photos(Galeri $galeri)
    {
        $photos = $galeri->photos()->orderBy('order')->get()->map(function ($photo) {
            return [
                'id' => $photo->id,
                'image' => $photo->image,
                'image_url' => $photo->image_url,
                'is_thumbnail' => $photo->is_thumbnail,
                'order' => $photo->order,
            ];
        });

        $thumbnail = $galeri->thumbnail;

        return response()->json([
            'photos' => $photos,
            'thumbnail_id' => $thumbnail ? $thumbnail->id : null,
        ]);
    }
}
