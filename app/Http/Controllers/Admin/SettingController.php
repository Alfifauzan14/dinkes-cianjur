<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Show the form for editing the site settings.
     */
    public function edit(): View
    {
        $setting = Setting::firstOrCreate(['id' => 1], [
            'site_name' => 'Dinas Kesehatan Kabupaten Cianjur',
            'site_tagline' => 'Mewujudkan masyarakat Cianjur yang sehat, mandiri, dan berkeadilan.',
            'site_logo' => null,
            'address' => 'Jl. Pangeran No. 105, Cianjur, Jawa Barat.',
            'phone' => '(0263) 261XXX',
            'email' => 'kontak@dinkes.cianjurkab.go.id',
            'emergency_call' => '119',
            'emergency_title' => 'Ambulans Gawat Darurat: PSC 119 Cianjur',
            'social_facebook' => 'https://facebook.com',
            'social_instagram' => 'https://instagram.com',
            'social_twitter' => 'https://x.com',
            'social_youtube' => 'https://youtube.com',
            'social_tiktok' => 'https://tiktok.com',
        ]);

        return view('admin.setting.edit', compact('setting'));
    }

    /**
     * Update the site settings in storage.
     */
    public function update(Request $request): RedirectResponse
    {
        $rules = [
            'site_name' => 'required|string|max:255',
            'site_tagline' => 'required|string|max:255',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'emergency_call' => 'required|string|max:255',
            'emergency_title' => 'required|string|max:255',
            'social_facebook' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'social_tiktok' => 'nullable|url|max:255',
        ];

        $request->validate($rules);

        $setting = Setting::firstOrCreate(['id' => 1]);

        $data = $request->except(['site_logo', '_token', '_method']);

        // Handle Site Logo Upload
        if ($request->hasFile('site_logo')) {
            $image = $request->file('site_logo');
            $imageName = 'logo_'.time().'_'.Str::random(8).'.'.$image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/settings');
            if (! File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            // Hapus gambar lama jika ada
            if ($setting->site_logo) {
                $oldImagePath = public_path('uploads/settings/'.$setting->site_logo);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $image->move($destinationPath, $imageName);
            $data['site_logo'] = $imageName;
        }

        $setting->update($data);

        return redirect()->route('admin.setting.edit', ['section' => $request->input('section', 'identitas')])
            ->with('success', 'Pengaturan situs berhasil diperbarui!');
    }
}
