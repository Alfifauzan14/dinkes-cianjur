<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Show the settings edit page.
     */
    public function edit(): \Illuminate\View\View
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.setting.edit', compact('settings'));
    }

    /**
     * Update settings in the database.
     */
    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'header_site_name'     => 'required|string|max:255',
            'header_tagline'       => 'nullable|string|max:255',
            'footer_tagline'       => 'nullable|string|max:500',
            'footer_address'       => 'nullable|string|max:500',
            'footer_phone'         => 'nullable|string|max:50',
            'footer_email'         => 'nullable|email|max:255',
            'footer_emergency_text'=> 'nullable|string|max:255',
            'footer_emergency_phone'=> 'nullable|string|max:50',
            'footer_copyright'     => 'nullable|string|max:255',
            // Quick nav links
            'footer_nav_1_label'   => 'nullable|string|max:100',
            'footer_nav_1_url'     => 'nullable|string|max:500',
            'footer_nav_2_label'   => 'nullable|string|max:100',
            'footer_nav_2_url'     => 'nullable|string|max:500',
            'footer_nav_3_label'   => 'nullable|string|max:100',
            'footer_nav_3_url'     => 'nullable|string|max:500',
            'footer_nav_4_label'   => 'nullable|string|max:100',
            'footer_nav_4_url'     => 'nullable|string|max:500',
            // Social media
            'social_facebook'      => 'nullable|url|max:500',
            'social_instagram'     => 'nullable|url|max:500',
            'social_twitter'       => 'nullable|url|max:500',
            'social_youtube'       => 'nullable|url|max:500',
            'social_tiktok'        => 'nullable|url|max:500',
        ]);

        $keys = [
            'header_site_name', 'header_tagline',
            'footer_tagline', 'footer_address', 'footer_phone', 'footer_email',
            'footer_emergency_text', 'footer_emergency_phone', 'footer_copyright',
            'footer_nav_1_label', 'footer_nav_1_url',
            'footer_nav_2_label', 'footer_nav_2_url',
            'footer_nav_3_label', 'footer_nav_3_url',
            'footer_nav_4_label', 'footer_nav_4_url',
            'social_facebook', 'social_instagram', 'social_twitter',
            'social_youtube', 'social_tiktok',
            // Per-page headers
            'page_profil_title', 'page_profil_subtitle',
            'page_berita_title', 'page_berita_subtitle',
            'page_agenda_title', 'page_agenda_subtitle',
            'page_media_title', 'page_media_subtitle',
            'page_faskes_title', 'page_faskes_subtitle',
            'page_labkesda_title', 'page_labkesda_subtitle',
            'page_ppid_title', 'page_ppid_subtitle',
            'page_layanan_title', 'page_layanan_subtitle',
            'page_kia_title', 'page_kia_subtitle',
            'page_stunting_title', 'page_stunting_subtitle',
        ];

        foreach ($keys as $key) {
            Setting::set($key, $request->input($key, ''));
        }

        return redirect()->route('admin.setting.edit')
            ->with('success', 'Pengaturan berhasil disimpan!');
    }
}
