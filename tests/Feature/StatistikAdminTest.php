<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatistikAdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest cannot access admin statistics.
     */
    public function test_guest_cannot_access_admin_statistik(): void
    {
        $response = $this->get('/admin/satu-data/statistik');
        $response->assertRedirect('/dinkes-login');
    }

    /**
     * Test admin can view edit statistics form.
     */
    public function test_admin_can_view_statistik_edit_page(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $response = $this->actingAs($admin)
            ->get('/admin/satu-data/statistik');

        $response->assertStatus(200);
        $response->assertSee('Indikator Utama');
        $response->assertSee('47');
    }

    /**
     * Test admin can update statistics and stunting records.
     */
    public function test_admin_can_update_statistik_settings_and_stunting_records(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        // 1. Update Indikator
        $response = $this->actingAs($admin)
            ->put('/admin/satu-data/statistik', [
                'section' => 'indikator',
                'status_badge' => 'Data Diperbarui 2026',
                'indikator_names' => ['PUSKESMAS', 'RS RUJUKAN', 'SDM KESEHATAN', 'IMUNISASI'],
                'indikator_nums' => ['50', '10', '4,000', '96.2%'],
                'indikator_captions' => ['Akreditasi Paripurna Terjamin', '5 RSUD + 5 RS Swasta', 'Seluruh Nakes Terdaftar', 'Target Imunisasi Tercapai'],
            ]);
        $response->assertRedirect('/admin/satu-data/statistik?section=indikator');

        // 2. Update Stunting
        $response = $this->actingAs($admin)
            ->put('/admin/satu-data/statistik', [
                'section' => 'stunting',
                'stunting_title' => 'Tren Penurunan Prevalensi Stunting',
                'stunting_subtitle' => 'Kabupaten Cianjur 2014-2024',
                'stunting_years' => ['2024', '2025', '2026'],
                'stunting_total_balita' => ['44100', '43000', '42000'],
                'stunting_balita_stunt' => ['4254', '3800', '3200'],
                'highlighted_year' => '2026',
            ]);
        $response->assertRedirect('/admin/satu-data/statistik?section=stunting');

        // 3. Update Nakes
        $response = $this->actingAs($admin)
            ->put('/admin/satu-data/statistik', [
                'section' => 'nakes',
                'nakes_names' => ['Perawat', 'Bidan'],
                'nakes_values' => ['1600', '1600'],
                'nakes_widths' => ['50', '50'],
            ]);
        $response->assertRedirect('/admin/satu-data/statistik?section=nakes');

        // 4. Update Sebaran
        $response = $this->actingAs($admin)
            ->put('/admin/satu-data/statistik', [
                'section' => 'sebaran',
                'sebaran_names' => ['Zonasi Selatan', 'Zonasi Utara'],
                'sebaran_values' => ['25', '25'],
                'sebaran_widths' => ['50', '50'],
            ]);
        $response->assertRedirect('/admin/satu-data/statistik?section=sebaran');

        $this->assertDatabaseHas('statistik_settings', [
            'id' => 1,
            'indikator_data' => json_encode([
                ['name' => 'PUSKESMAS', 'num' => '50', 'caption' => 'Akreditasi Paripurna Terjamin'],
                ['name' => 'RS RUJUKAN', 'num' => '10', 'caption' => '5 RSUD + 5 RS Swasta'],
                ['name' => 'SDM KESEHATAN', 'num' => '4000', 'caption' => 'Seluruh Nakes Terdaftar'],
                ['name' => 'IMUNISASI', 'num' => '96.2', 'caption' => 'Target Imunisasi Tercapai'],
            ]),
        ]);

        $this->assertDatabaseHas('stunting_records', [
            'year' => 2026,
            'balita_stunting' => 3200,
            'is_highlighted' => true,
        ]);
    }
}
