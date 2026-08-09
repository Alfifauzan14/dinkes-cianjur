<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeaderSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeaderSettingController extends Controller
{
    public function index(): View
    {
        $order = [
            'profil',
            'visi-misi',
            'struktur-organisasi',
            'program-kesehatan',
            'layanan-terpadu',
            'labkesda',
            'ikm',
            'pagoda-sehat',
            'faskes',
            'statistik',
            'laporan',
            'regulasi',
            'ppid',
            'berita',
            'agenda',
            'media',
        ];

        $headers = HeaderSetting::all()->sortBy(function ($header) use ($order) {
            $index = array_search($header->page_key, $order);
            return $index === false ? 999 : $index;
        });

        return view('admin.header.index', compact('headers'));
    }

    public function update(Request $request, HeaderSetting $header): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
        ]);

        $header->update($request->only('title', 'subtitle'));

        return redirect()->route('admin.headers.index')
            ->with('success', "Header untuk halaman {$header->page_name} berhasil diperbarui.");
    }
}
