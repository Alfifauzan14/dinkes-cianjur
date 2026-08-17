<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Regulasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegulasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category');

        $regulasis = Regulasi::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('title', 'like', '%'.$search.'%')
                        ->orWhere('description', 'like', '%'.$search.'%')
                        ->orWhere('topic', 'like', '%'.$search.'%');
                });
            })
            ->when($category, fn ($q) => $q->where('category', $category))
            ->orderBy('year', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $kategoris = Kategori::ofType('regulasi')->orderBy('nama')->get();

        return view('admin.regulasi.index', compact('regulasis', 'kategoris', 'search', 'category'));
    }

    public function create()
    {
        $kategoris = Kategori::ofType('regulasi')->orderBy('nama')->get();

        return view('admin.regulasi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100', // e.g. PERATURAN BUPATI
            'topic' => 'required|string|max:100', // e.g. PERBUP STUNTING
            'description' => 'required|string',
            'year' => 'required|integer|min:2000|max:2100',
            'file_cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file_document' => 'required|file|mimes:pdf|max:10240',
            'status' => 'required|string|in:Berlaku,Tidak Berlaku',
        ]);

        $docFile = $request->file('file_document');
        $docPath = $docFile->store('regulasi/documents', 'public');

        // Calculate size
        $bytes = $docFile->getSize();
        if ($bytes >= 1048576) {
            $size = number_format($bytes / 1048576, 1).' MB';
        } elseif ($bytes >= 1024) {
            $size = number_format($bytes / 1024, 0).' KB';
        } else {
            $size = $bytes.' B';
        }

        $coverPath = null;
        if ($request->hasFile('file_cover')) {
            $coverPath = $request->file('file_cover')->store('regulasi/covers', 'public');
        }

        Regulasi::create([
            'title' => $request->title,
            'category' => $request->category,
            'topic' => $request->topic,
            'description' => $request->description,
            'year' => $request->year,
            'cover_path' => $coverPath,
            'file_path' => $docPath,
            'file_size' => $size,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil ditambahkan!');
    }

    public function edit(Regulasi $regulasi)
    {
        $kategoris = Kategori::ofType('regulasi')->orderBy('nama')->get();

        return view('admin.regulasi.edit', compact('regulasi', 'kategoris'));
    }

    public function update(Request $request, Regulasi $regulasi)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'topic' => 'required|string|max:100',
            'description' => 'required|string',
            'year' => 'required|integer|min:2000|max:2100',
            'file_cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'file_document' => 'nullable|file|mimes:pdf|max:10240',
            'status' => 'required|string|in:Berlaku,Tidak Berlaku',
        ]);

        $data = [
            'title' => $request->title,
            'category' => $request->category,
            'topic' => $request->topic,
            'description' => $request->description,
            'year' => $request->year,
            'status' => $request->status,
        ];

        if ($request->hasFile('file_cover')) {
            if ($regulasi->cover_path) {
                Storage::disk('public')->delete($regulasi->cover_path);
            }
            $data['cover_path'] = $request->file('file_cover')->store('regulasi/covers', 'public');
        }

        if ($request->hasFile('file_document')) {
            if ($regulasi->file_path) {
                Storage::disk('public')->delete($regulasi->file_path);
            }
            $docFile = $request->file('file_document');
            $docPath = $docFile->store('regulasi/documents', 'public');
            $bytes = $docFile->getSize();
            if ($bytes >= 1048576) {
                $size = number_format($bytes / 1048576, 1).' MB';
            } elseif ($bytes >= 1024) {
                $size = number_format($bytes / 1024, 0).' KB';
            } else {
                $size = $bytes.' B';
            }

            $data['file_path'] = $docPath;
            $data['file_size'] = $size;
        }

        $regulasi->update($data);

        return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil diperbarui!');
    }

    public function destroy(Regulasi $regulasi)
    {
        if ($regulasi->cover_path) {
            Storage::disk('public')->delete($regulasi->cover_path);
        }
        if ($regulasi->file_path) {
            Storage::disk('public')->delete($regulasi->file_path);
        }
        $regulasi->delete();

        return redirect()->route('admin.regulasi.index')->with('success', 'Regulasi berhasil dihapus!');
    }
}
