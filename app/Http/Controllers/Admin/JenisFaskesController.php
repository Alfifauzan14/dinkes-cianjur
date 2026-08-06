<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisFaskes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JenisFaskesController extends Controller
{
    public function index(): View
    {
        $types = JenisFaskes::orderBy('name')->get();

        return view('admin.jenis_faskes.index', compact('types'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:jenis_faskes,name',
        ]);

        JenisFaskes::create($request->only('name'));

        return redirect()->route('admin.jenis-faskes.index')
            ->with('success', 'Jenis Faskes berhasil ditambahkan.');
    }

    public function update(Request $request, JenisFaskes $jenisFaskes): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:jenis_faskes,name,'.$jenisFaskes->id,
        ]);

        $jenisFaskes->update($request->only('name'));

        return redirect()->route('admin.jenis-faskes.index')
            ->with('success', 'Jenis Faskes berhasil diperbarui.');
    }

    public function destroy(JenisFaskes $jenisFaskes): RedirectResponse
    {
        $jenisFaskes->delete();

        return redirect()->route('admin.jenis-faskes.index')
            ->with('success', 'Jenis Faskes berhasil dihapus.');
    }
}
