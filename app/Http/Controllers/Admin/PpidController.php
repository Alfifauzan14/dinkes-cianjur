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
    public function edit(Request $request): View
    {
        $ppid = PpidSetting::instance();

        $section = $request->query('section', 'informasi');
        if (! in_array($section, ['informasi', 'statistik', 'tautan', 'tatacara'])) {
            $section = 'informasi';
        }

        return view('admin.ppid.'.$section, compact('ppid'));
    }

    /**
     * Update PPID settings in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $section = $request->input('section', 'informasi');
        $rules = [];

        if ($section === 'statistik') {
            $rules = [
                'page_title' => 'required|string|max:255',
                'page_subtitle' => 'nullable|string|max:500',
                'stat_numbers' => 'nullable|array',
                'stat_numbers.*' => 'nullable|numeric',
                'stat_descs' => 'nullable|array',
                'stat_descs.*' => 'nullable|string|max:500',
            ];
        } elseif ($section === 'informasi') {
            $rules = [
                'accordion_items' => 'nullable|array',
                'accordion_items.*.title' => 'required|string|max:255',
                'accordion_items.*.category' => 'required|string|in:berkala,serta-merta,setiap-saat',
                'accordion_items.*.content' => 'required|string',
            ];
        } elseif ($section === 'tautan') {
            $rules = [
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
            ];
        } elseif ($section === 'tatacara') {
            $rules = [
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
            ];
        }

        $request->validate($rules);

        $ppid = PpidSetting::instance();

        if ($section === 'informasi') {
            // Update accordion items specifically
            $ppid->update([
                'accordion_items' => $request->input('accordion_items', []),
            ]);
        } elseif ($section === 'statistik') {
            $numbers = $request->input('stat_numbers', []);
            $descs = $request->input('stat_descs', []);

            $data = [
                'page_title' => $request->input('page_title'),
                'page_subtitle' => $request->input('page_subtitle'),
            ];

            for ($i = 1; $i <= 10; $i++) {
                $idx = $i - 1;
                $data["stat_{$i}_number"] = $numbers[$idx] ?? '';
                $data["stat_{$i}_desc"] = $descs[$idx] ?? '';
            }

            $ppid->update($data);
        } else {
            $data = $request->only(array_filter(array_keys($rules), function ($key) {
                return ! str_contains($key, '*');
            }));
            $ppid->update($data);
        }

        return redirect()->route('admin.ppid.edit', ['section' => $section])
            ->with('success', 'Konten halaman PPID berhasil diperbarui!');
    }
}
