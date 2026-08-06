<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KecamatanController extends Controller
{
    public function index(): View
    {
        $kecamatans = Kecamatan::orderBy('name')->get();

        return view('admin.kecamatan.index', compact('kecamatans'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:kecamatans,name',
        ]);

        Kecamatan::create($request->only('name'));

        return redirect()->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil ditambahkan.');
    }

    public function update(Request $request, Kecamatan $kecamatan): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:kecamatans,name,'.$kecamatan->id,
        ]);

        $kecamatan->update($request->only('name'));

        return redirect()->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil diperbarui.');
    }

    public function destroy(Kecamatan $kecamatan): RedirectResponse
    {
        $kecamatan->delete();

        return redirect()->route('admin.kecamatan.index')
            ->with('success', 'Kecamatan berhasil dihapus.');
    }
}
