<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingFooter;
use App\Services\ImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class SettingFooterController extends Controller
{
    public function edit(Request $request): View
    {
        $setting = SettingFooter::firstOrCreate(['id' => 1], [
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

        return view('admin.settingfooter.edit', compact('setting'));
    }

    public function update(Request $request): RedirectResponse
    {
        $rules = [
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'site_tagline' => 'required|string|max:255',
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

        $setting = SettingFooter::firstOrCreate(['id' => 1]);

        $data = $request->only(array_keys($rules));

        if ($request->hasFile('site_logo')) {
            $destinationPath = public_path('uploads/settings');

            if ($setting->site_logo) {
                $oldImagePath = public_path('uploads/settings/'.$setting->site_logo);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $data['site_logo'] = ImageService::compressAndUpload($request->file('site_logo'), $destinationPath, 600, 90);
        }

        $setting->update($data);

        return redirect()->route('admin.settingfooter.edit')
            ->with('success', 'Pengaturan footer berhasil diperbarui!');
    }
}
