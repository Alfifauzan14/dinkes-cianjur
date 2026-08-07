<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingFooterAdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest cannot access admin settings.
     */
    public function test_guest_cannot_access_admin_settings(): void
    {
        $response = $this->get('/admin/setting-footer');
        $response->assertRedirect('/dinkes-login');
    }

    /**
     * Test admin can view settings edit page.
     */
    public function test_admin_can_view_settings_edit_page(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/setting-footer');
        $response->assertStatus(200);
        $response->assertSee('Pengaturan Footer');
    }

    /**
     * Test admin can update all footer settings at once.
     */
    public function test_admin_can_update_settings(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->put('/admin/setting-footer', [
            'site_tagline' => 'Tagline Dinas Baru',
            'address' => 'Jl. Baru No. 12',
            'phone' => '08123456789',
            'email' => 'baru@dinkes.com',
            'emergency_call' => '112',
            'emergency_title' => 'PSC 112 Baru',
            'social_facebook' => 'https://facebook.com/baru',
            'social_instagram' => 'https://instagram.com/baru',
            'social_twitter' => 'https://x.com/baru',
            'social_youtube' => 'https://youtube.com/baru',
            'social_tiktok' => 'https://tiktok.com/baru',
        ]);
        $response->assertRedirect('/admin/setting-footer');
        $response->assertSessionHas('success', 'Pengaturan footer berhasil diperbarui!');

        $this->assertDatabaseHas('settings', [
            'id' => 1,
            'site_tagline' => 'Tagline Dinas Baru',
            'address' => 'Jl. Baru No. 12',
            'phone' => '08123456789',
            'email' => 'baru@dinkes.com',
            'emergency_call' => '112',
            'emergency_title' => 'PSC 112 Baru',
        ]);
    }
}
