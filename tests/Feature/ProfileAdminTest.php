<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileAdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test public welcome page runs successfully and renders profile values.
     */
    public function test_welcome_page_renders_profile_values(): void
    {
        $profile = Profile::create([
            'kepala_dinas_name' => 'Dr. Budi Santoso',
            'kepala_dinas_role' => 'Kepala Dinas',
            'sambutan_title' => 'Judul Sambutan Budi',
            'sambutan_quote' => 'Kutipan Budi',
            'sambutan_desc_1' => 'Deskripsi Budi 1',
            'sambutan_desc_2' => 'Deskripsi Budi 2',
            'sejarah_title' => 'Judul Sejarah',
            'sejarah_text_1' => 'Teks Sejarah 1',
            'sejarah_text_2' => 'Teks Sejarah 2',
            'sejarah_image' => 'logo_custom.png',
            'visi_title' => 'Visi Budi',
            'visi_desc' => 'Visi Desc',
            'stat_1_text' => 'Stat 1',
            'stat_2_text' => 'Stat 2',
            'misi' => [
                ['title' => 'Misi 1', 'desc' => 'Desc 1'],
                ['title' => 'Misi 2', 'desc' => 'Desc 2'],
            ],
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Dr. Budi Santoso');
        $response->assertSee('Judul Sambutan Budi');
    }

    /**
     * Test public about dinkes page renders profile values.
     */
    public function test_about_page_renders_profile_values(): void
    {
        $profile = Profile::create([
            'kepala_dinas_name' => 'Dr. Budi',
            'kepala_dinas_role' => 'Kepala Dinas',
            'sambutan_title' => 'Judul',
            'sambutan_quote' => 'Quote',
            'sambutan_desc_1' => 'Desc 1',
            'sambutan_desc_2' => 'Desc 2',
            'sejarah_title' => 'Perjalanan Dinas Budi',
            'sejarah_text_1' => 'Teks Sejarah 1',
            'sejarah_text_2' => 'Teks Sejarah 2',
            'sejarah_image' => 'logo_custom.png',
            'visi_title' => 'Visi Budi',
            'visi_desc' => 'Visi Desc',
            'stat_1_text' => 'Stat 1',
            'stat_2_text' => 'Stat 2',
            'misi' => [
                ['title' => 'Misi 1', 'desc' => 'Desc 1'],
            ],
        ]);

        $response = $this->get('/profil/tentang-dinkes');
        $response->assertStatus(200);
        $response->assertSee('Perjalanan Dinas Budi');

        $responseVisiMisi = $this->get('/profil/visi-misi');
        $responseVisiMisi->assertStatus(200);
        $responseVisiMisi->assertSee('Misi 1');
    }

    /**
     * Test guest is redirected when accessing admin profile edit.
     */
    public function test_guest_cannot_access_admin_profile_edit(): void
    {
        $response = $this->get('/admin/profil');
        $response->assertRedirect('/dinkes-login');
    }

    /**
     * Test admin can update profile settings.
     */
    public function test_admin_can_update_profile_settings(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $profile = Profile::create([
            'id' => 1,
            'kepala_dinas_name' => 'Nama Awal',
            'kepala_dinas_role' => 'Jabatan Awal',
            'sambutan_title' => 'Judul Awal',
            'sambutan_quote' => 'Quote Awal',
            'sambutan_desc_1' => 'Desc Awal 1',
            'sambutan_desc_2' => 'Desc Awal 2',
            'sejarah_title' => 'Sejarah Awal',
            'sejarah_text_1' => 'Teks Awal 1',
            'sejarah_text_2' => 'Teks Awal 2',
            'sejarah_image' => null,
            'visi_title' => 'Visi Awal',
            'visi_desc' => 'Visi Desc Awal',
            'stat_1_text' => 'Stat Awal 1',
            'stat_2_text' => 'Stat Awal 2',
            'misi' => [
                ['title' => 'Misi Awal', 'desc' => 'Desc Awal'],
            ],
        ]);

        $response = $this->actingAs($admin)
            ->put('/admin/profil', [
                'kepala_dinas_name' => 'Nama Baru',
                'kepala_dinas_role' => 'Jabatan Baru',
                'sambutan_title' => 'Judul Baru',
                'sambutan_quote' => 'Quote Baru',
                'sambutan_desc_1' => 'Desc Baru 1',
                'sambutan_desc_2' => 'Desc Baru 2',
                'sejarah_title' => 'Sejarah Baru',
                'sejarah_text_1' => 'Teks Baru 1',
                'sejarah_text_2' => 'Teks Baru 2',
                'visi_title' => 'Visi Baru',
                'visi_desc' => 'Visi Desc Baru',
                'stat_1_text' => 'Stat Baru 1',
                'stat_2_text' => 'Stat Baru 2',
                'misi' => [
                    ['title' => 'Misi Baru 1', 'desc' => 'Desc Baru 1'],
                    ['title' => 'Misi Baru 2', 'desc' => 'Desc Baru 2'],
                ],
            ]);

        $response->assertRedirect(route('admin.profil.edit'));
        $this->assertDatabaseHas('profiles', [
            'id' => 1,
            'kepala_dinas_name' => 'Nama Baru',
            'kepala_dinas_role' => 'Jabatan Baru',
        ]);

        $updatedProfile = Profile::find(1);
        $this->assertCount(2, $updatedProfile->misi);
        $this->assertEquals('Misi Baru 1', $updatedProfile->misi[0]['title']);
    }
}
