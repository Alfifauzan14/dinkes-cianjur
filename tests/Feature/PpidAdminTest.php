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
        $response->assertSee('Informasi Publik (Accordion)');
        $response->assertSee('PPID Dinas Kesehatan Kabupaten Cianjur');
    }

    /**
     * Test admin can update PPID settings.
     */
    public function test_admin_can_update_ppid_settings(): void
    {
        $admin = User::factory()->create();

        $data = [
            'page_title' => 'PPID Baru',
            'page_subtitle' => 'Subtitle Baru',
            'stat_1_number' => '100',
            'stat_1_desc' => 'Deskripsi 100',
            'stat_2_number' => '200',
            'stat_2_desc' => 'Deskripsi 200',
            'stat_3_number' => '300',
            'stat_3_desc' => 'Deskripsi 300',
            'tautan_badge' => 'Badge Baru',
            'tautan_title' => 'Tautan Baru',
            'tautan_subtitle' => 'Tautan Subtitle Baru',
            'tata_cara_badge' => 'Cara Badge Baru',
            'tata_cara_heading' => 'Cara Heading Baru',
            'btn_daftar_label' => 'Daftar Label Baru',
            'btn_daftar_url' => 'https://daftar.com',
            'btn_login_label' => 'Login Label Baru',
            'btn_login_url' => 'https://login.com',
            'tata_cara_card_1_title' => 'Langkah 1',
            'tata_cara_card_1_text' => 'Teks 1',
            'tata_cara_card_2_title' => 'Langkah 2',
            'tata_cara_card_2_text' => 'Teks 2',
            'tata_cara_card_3_title' => 'Langkah 3',
            'tata_cara_card_3_text' => 'Teks 3',
            'tata_cara_card_4_title' => 'Langkah 4',
            'tata_cara_card_4_text' => 'Teks 4',
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
        ];

        $response = $this->actingAs($admin)->put('/admin/ppid', $data);
        $response->assertRedirect('/admin/ppid');
        $response->assertSessionHas('success', 'Konten halaman PPID berhasil diperbarui!');

        $this->assertDatabaseHas('ppid_settings', [
            'id' => 1,
            'page_title' => 'PPID Baru',
            'page_subtitle' => 'Subtitle Baru',
        ]);

        $setting = PpidSetting::first();
        $this->assertCount(2, $setting->accordion_items);
        $this->assertEquals('Accordion 1', $setting->accordion_items[0]['title']);
    }
}
