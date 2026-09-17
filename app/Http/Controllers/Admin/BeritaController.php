<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Berita::query();

        // Pencarian berdasarkan judul atau isi
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $beritas = $query->orderBy('created_at', 'desc')->paginate(10);

        $kategoris = Kategori::ofType('berita')->get();

        return view('admin.berita.index', compact('beritas', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::ofType('berita')->get();

        return view('admin.berita.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'status' => 'required|string|in:published,draft',
        ]);

        $data = $request->only(['title', 'category', 'content', 'status']);
        $data['slug'] = Str::slug($request->title);

        // Upload Gambar jika ada
        if ($request->hasFile('image')) {
            $destinationPath = public_path('uploads/berita');
            $data['image'] = ImageService::compressAndUpload($request->file('image'), $destinationPath, 1920, 82);
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diterbitkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        $kategoris = Kategori::ofType('berita')->get();

        return view('admin.berita.edit', compact('berita', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'status' => 'required|string|in:published,draft',
        ]);

        $data = $request->only(['title', 'category', 'content', 'status']);
        $data['slug'] = Str::slug($request->title);

        // Upload Gambar Baru jika ada
        if ($request->hasFile('image')) {
            $destinationPath = public_path('uploads/berita');

            // Hapus gambar lama jika ada
            if ($berita->image) {
                $oldImagePath = public_path('uploads/berita/'.$berita->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $data['image'] = ImageService::compressAndUpload($request->file('image'), $destinationPath, 1920, 82);
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        // Hapus file gambar jika ada
        if ($berita->image) {
            $imagePath = public_path('uploads/berita/'.$berita->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}
