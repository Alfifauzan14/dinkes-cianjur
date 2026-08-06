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
        $response->assertSee('Identitas Utama Website');
    }

    /**
     * Test admin can update settings.
     */
    public function test_admin_can_update_settings(): void
    {
        $admin = User::factory()->create();

        // 1. Update Identitas
        $response = $this->actingAs($admin)->put('/admin/setting-footer', [
            'section' => 'identitas',
            'site_name' => 'Nama Dinas Baru',
            'site_tagline' => 'Tagline Dinas Baru',
        ]);
        $response->assertRedirect('/admin/setting-footer?section=identitas');
        $response->assertSessionHas('success', 'Pengaturan situs berhasil diperbarui!');

        // 2. Update Kontak
        $response = $this->actingAs($admin)->put('/admin/setting-footer', [
            'section' => 'kontak',
            'address' => 'Jl. Baru No. 12',
            'phone' => '08123456789',
            'email' => 'baru@dinkes.com',
        ]);
        $response->assertRedirect('/admin/setting-footer?section=kontak');

        // 3. Update Darurat
        $response = $this->actingAs($admin)->put('/admin/setting-footer', [
            'section' => 'darurat',
            'emergency_call' => '112',
            'emergency_title' => 'PSC 112 Baru',
        ]);
        $response->assertRedirect('/admin/setting-footer?section=darurat');

        $this->assertDatabaseHas('settings', [
            'id' => 1,
            'site_name' => 'Nama Dinas Baru',
            'site_tagline' => 'Tagline Dinas Baru',
            'address' => 'Jl. Baru No. 12',
            'phone' => '08123456789',
            'email' => 'baru@dinkes.com',
            'emergency_call' => '112',
            'emergency_title' => 'PSC 112 Baru',
        ]);
    }
}
