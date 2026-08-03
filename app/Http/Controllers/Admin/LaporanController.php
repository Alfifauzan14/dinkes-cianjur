<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::orderBy('release_date', 'desc')->get();
        return view('admin.laporan.index', compact('laporans'));
    }

    public function create()
    {
        return view('admin.laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|string|in:Laporan Kinerja,Laporan Keuangan,Informasi Publik',
            'file_document'=> 'required|file|mimes:pdf|max:10240', // max 10MB
            'release_date' => 'required|date',
        ]);

        $file = $request->file('file_document');
        $path = $file->store('laporan', 'public');

        // Calculate human readable file size
        $bytes = $file->getSize();
        if ($bytes >= 1048576) {
            $size = number_format($bytes / 1048576, 1) . ' MB';
        } elseif ($bytes >= 1024) {
            $size = number_format($bytes / 1024, 0) . ' KB';
        } else {
            $size = $bytes . ' B';
        }

        Laporan::create([
            'title'        => $request->title,
            'category'     => $request->category,
            'file_path'    => $path,
            'file_size'    => $size,
            'release_date' => $request->release_date,
        ]);

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil ditambahkan!');
    }

    public function edit(Laporan $laporan)
    {
        return view('admin.laporan.edit', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'category'     => 'required|string|in:Laporan Kinerja,Laporan Keuangan,Informasi Publik',
            'file_document'=> 'nullable|file|mimes:pdf|max:10240',
            'release_date' => 'required|date',
        ]);

        $data = [
            'title'        => $request->title,
            'category'     => $request->category,
            'release_date' => $request->release_date,
        ];

        if ($request->hasFile('file_document')) {
            // Delete old file
            if ($laporan->file_path) {
                Storage::disk('public')->delete($laporan->file_path);
            }

            $file = $request->file('file_document');
            $path = $file->store('laporan', 'public');
            $bytes = $file->getSize();
            if ($bytes >= 1048576) {
                $size = number_format($bytes / 1048576, 1) . ' MB';
            } elseif ($bytes >= 1024) {
                $size = number_format($bytes / 1024, 0) . ' KB';
            } else {
                $size = $bytes . ' B';
            }

            $data['file_path'] = $path;
            $data['file_size'] = $size;
        }

        $laporan->update($data);

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy(Laporan $laporan)
    {
        if ($laporan->file_path) {
            Storage::disk('public')->delete($laporan->file_path);
        }
        $laporan->delete();

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan berhasil dihapus!');
    }
}
