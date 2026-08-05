<?php

namespace Tests\Feature;

use App\Models\PpidSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PpidAdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest cannot access PPID settings.
     */
    public function test_guest_cannot_access_ppid_settings(): void
    {
        $response = $this->get('/admin/ppid');
        $response->assertRedirect('/dinkes-login');
    }

    /**
     * Test admin can view PPID settings page.
     */
    public function test_admin_can_view_ppid_settings_page(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->get('/admin/ppid');
        $response->assertStatus(200);
        $response->assertSee('Daftar Informasi Publik');
    }

    /**
     * Test admin can update PPID settings.
     */
    public function test_admin_can_update_ppid_settings(): void
    {
        $admin = User::factory()->create();

        // 1. Update Statistik/Header
        $response = $this->actingAs($admin)->put('/admin/ppid', [
            'section' => 'statistik',
            'page_title' => 'PPID Baru',
            'page_subtitle' => 'Subtitle Baru',
            'stat_1_number' => '100',
            'stat_1_desc' => 'Deskripsi 100',
        ]);
        $response->assertRedirect('/admin/ppid?section=statistik');

        // 2. Update Informasi (Accordion)
        $response = $this->actingAs($admin)->put('/admin/ppid', [
            'section' => 'informasi',
            'accordion_items' => [
                [
                    'title' => 'Accordion 1',
                    'category' => 'berkala',
                    'content' => 'Content 1',
                ],
                [
                    'title' => 'Accordion 2',
                    'category' => 'serta-merta',
                    'content' => 'Content 2',
                ],
            ]
        ]);
        $response->assertRedirect('/admin/ppid?section=informasi');
        $response->assertSessionHas('success', 'Konten halaman PPID berhasil diperbarui!');

        $this->assertDatabaseHas('ppid_settings', [
            'id' => 1,
            'page_title' => 'PPID Baru',
            'page_subtitle' => 'Subtitle Baru',
            'stat_1_number' => '100',
            'stat_1_desc' => 'Deskripsi 100',
        ]);

        $setting = PpidSetting::first();
        $this->assertCount(2, $setting->accordion_items);
        $this->assertEquals('Accordion 1', $setting->accordion_items[0]['title']);
    }
}
