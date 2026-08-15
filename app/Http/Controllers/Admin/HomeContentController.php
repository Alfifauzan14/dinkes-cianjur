<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeInfoCard;
use App\Models\HomeSocialLink;
use App\Models\Setting;
use App\Models\SettingFooter;
use Illuminate\Http\Request;

class HomeContentController extends Controller
{
    public const ICON_OPTIONS = ['map', 'phone', 'document', 'heart', 'shield', 'users'];

    public const SOCIAL_PLATFORMS = ['instagram', 'tiktok', 'facebook', 'youtube'];

    public function index()
    {
        $cards = HomeInfoCard::orderBy('order_index')->get();

        $socialLinks = HomeSocialLink::orderBy('order_index')->get()
            ->keyBy('platform');

        return view('admin.home-content.index', compact('cards', 'socialLinks'));
    }

    public function edit(HomeInfoCard $homeInfoCard)
    {
        return view('admin.home-content.edit', [
            'card' => $homeInfoCard,
            'icons' => self::ICON_OPTIONS,
        ]);
    }

    public function update(Request $request, HomeInfoCard $homeInfoCard)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon_name' => 'required|in:'.implode(',', self::ICON_OPTIONS),
        ]);

        $homeInfoCard->update($validated);

        return redirect()->route('admin.home-content.index')
            ->with('success', 'Info Card berhasil diperbarui.');
    }

    public function updateSocialLinks(Request $request)
    {
        $validated = $request->validate([
            'social_links' => 'required|array',
            'social_links.*.url' => 'nullable|string|max:255',
        ]);

        $footerSetting = SettingFooter::firstOrCreate(['id' => 1]);

        foreach (self::SOCIAL_PLATFORMS as $platform) {
            $url = $validated['social_links'][$platform]['url'] ?? null;

            // Update HomeSocialLink (beranda/hero)
            HomeSocialLink::updateOrCreate(
                ['platform' => $platform],
                ['url' => $url ?: null, 'order_index' => array_search($platform, self::SOCIAL_PLATFORMS) + 1]
            );

            // Sync ke SettingFooter (footer) — kolom social_twitter tidak ada di SOCIAL_PLATFORMS, skip
            $footerKey = 'social_'.$platform;
            if (in_array($footerKey, $footerSetting->getFillable())) {
                $footerSetting->$footerKey = $url ?: null;
            }

            // Sync ke Setting key-value store
            Setting::set($footerKey, $url ?? '');
        }

        $footerSetting->save();

        return redirect()->route('admin.home-content.index')
            ->with('success', 'Link media sosial berhasil diperbarui.');
    }
}
