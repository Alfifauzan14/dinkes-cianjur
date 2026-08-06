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
        $headers = HeaderSetting::orderBy('page_name')->get();

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
