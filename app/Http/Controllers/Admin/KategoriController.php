<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KategoriController extends Controller
{
    private const TYPES = [
        'berita' => 'Berita',
        'program' => 'Program Kesehatan',
        'regulasi' => 'Regulasi',
        'laporan' => 'Laporan',
        'galeri' => 'Galeri',
    ];

    public function index(): View
    {
        $kategoris = Kategori::orderBy('type')->orderBy('nama')->get()->groupBy('type');

        return view('admin.kategori.index', [
            'kategoris' => $kategoris,
            'types' => self::TYPES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'type' => 'required|in:berita,program,regulasi,laporan,galeri',
            'warna' => 'required|string|max:20',
        ]);

        Kategori::create($request->only('nama', 'type', 'warna'));

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, Kategori $kategori): RedirectResponse
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'type' => 'required|in:berita,program,regulasi,laporan,galeri',
            'warna' => 'required|string|max:20',
        ]);

        $kategori->update($request->only('nama', 'type', 'warna'));

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Kategori $kategori): RedirectResponse
    {
        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
