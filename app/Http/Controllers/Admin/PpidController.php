<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpidSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PpidController extends Controller
{
    /**
     * Show the PPID settings edit form.
     */
    public function edit(): View
    {
        $ppid = PpidSetting::instance();

        return view('admin.ppid.edit', compact('ppid'));
    }

    /**
     * Update PPID settings in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'page_title' => 'required|string|max:255',
            'page_subtitle' => 'nullable|string|max:500',

            'stat_1_number' => 'nullable|string|max:50',
            'stat_1_desc' => 'nullable|string',
            'stat_2_number' => 'nullable|string|max:50',
            'stat_2_desc' => 'nullable|string',
            'stat_3_number' => 'nullable|string|max:50',
            'stat_3_desc' => 'nullable|string',

            'tautan_badge' => 'nullable|string|max:255',
            'tautan_title' => 'nullable|string|max:255',
            'tautan_subtitle' => 'nullable|string|max:500',

            'tautan_1_label' => 'nullable|string|max:255',
            'tautan_1_url' => 'nullable|string|max:500',
            'tautan_2_label' => 'nullable|string|max:255',
            'tautan_2_url' => 'nullable|string|max:500',
            'tautan_3_label' => 'nullable|string|max:255',
            'tautan_3_url' => 'nullable|string|max:500',
            'tautan_4_label' => 'nullable|string|max:255',
            'tautan_4_url' => 'nullable|string|max:500',
            'tautan_5_label' => 'nullable|string|max:255',
            'tautan_5_url' => 'nullable|string|max:500',

            'tata_cara_badge' => 'nullable|string|max:255',
            'tata_cara_heading' => 'nullable|string|max:255',

            'tata_cara_card_1_title' => 'nullable|string|max:255',
            'tata_cara_card_1_text' => 'nullable|string',
            'tata_cara_card_2_title' => 'nullable|string|max:255',
            'tata_cara_card_2_text' => 'nullable|string',
            'tata_cara_card_3_title' => 'nullable|string|max:255',
            'tata_cara_card_3_text' => 'nullable|string',
            'tata_cara_card_4_title' => 'nullable|string|max:255',
            'tata_cara_card_4_text' => 'nullable|string',

            'btn_daftar_label' => 'nullable|string|max:255',
            'btn_daftar_url' => 'nullable|string|max:500',
            'btn_login_label' => 'nullable|string|max:255',
            'btn_login_url' => 'nullable|string|max:500',

            'accordion_1_title' => 'nullable|string|max:255',
            'accordion_1_content' => 'nullable|string',
            'accordion_2_title' => 'nullable|string|max:255',
            'accordion_2_content' => 'nullable|string',
            'accordion_3_title' => 'nullable|string|max:255',
            'accordion_3_content' => 'nullable|string',
            'accordion_4_title' => 'nullable|string|max:255',
            'accordion_4_content' => 'nullable|string',
            'accordion_5_title' => 'nullable|string|max:255',
            'accordion_5_content' => 'nullable|string',
            'accordion_6_title' => 'nullable|string|max:255',
            'accordion_6_content' => 'nullable|string',
        ]);

        $ppid = PpidSetting::instance();
        $ppid->update($request->except(['_token', '_method']));

        return redirect()->route('admin.ppid.edit')
            ->with('success', 'Konten halaman PPID berhasil diperbarui!');
    }
}
