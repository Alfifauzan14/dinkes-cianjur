<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Galeri::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%");
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $galeris = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.galeri.index', compact('galeris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['title', 'category']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.Str::random(10).'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/galeri');
            if (! File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $image->move($destinationPath, $imageName);
            $data['image'] = $imageName;
        }

        Galeri::create($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['title', 'category']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'_'.Str::random(10).'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/galeri');
            if (! File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            // Hapus gambar lama jika ada
            if ($galeri->image) {
                $oldImagePath = public_path('uploads/galeri/'.$galeri->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image->move($destinationPath, $imageName);
            $data['image'] = $imageName;
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        if ($galeri->image) {
            $imagePath = public_path('uploads/galeri/'.$galeri->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil dihapus!');
    }
}
