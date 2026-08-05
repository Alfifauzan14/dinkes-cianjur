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
        $response->assertSee('47'); // Default Puskesmas number
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
                'stat_1_num' => '50',
                'stat_1_badge' => '100% Siap!',
                'stat_1_caption' => 'Akreditasi Paripurna Terjamin',
                'stat_2_num' => '10',
                'stat_2_badge' => 'Mitra BPJS+',
                'stat_2_caption' => '5 RSUD Pemda + 5 RS Swasta',
                'stat_3_num' => '4,000',
                'stat_3_badge' => 'Tersertifikasi Nasional',
                'stat_3_caption' => 'Seluruh Nakes Terdaftar',
                'stat_4_num' => '96.2%',
                'stat_4_badge' => '+4.0% YoY',
                'stat_4_caption' => 'Target Imunisasi Tercapai',
            ]);
        $response->assertRedirect('/admin/satu-data/statistik?section=indikator');

        // 2. Update Stunting
        $response = $this->actingAs($admin)
            ->put('/admin/satu-data/statistik', [
                'section' => 'stunting',
                'stunting_title' => 'Tren Penurunan Stunting Baru',
                'stunting_subtitle' => 'Target Daerah Cianjur Baru: <5%',
                'stunting_trend_badge' => 'Tren Positif Baru',
                'stunting_footer_note' => 'Penurunan signifikan tercatat.',
                'stunting_years' => ['2024', '2025', '2026'],
                'stunting_rates' => ['18.2', '14.7', '9.8'],
                'highlighted_year' => '2026',
            ]);
        $response->assertRedirect('/admin/satu-data/statistik?section=stunting');

        // 3. Update Nakes
        $response = $this->actingAs($admin)
            ->put('/admin/satu-data/statistik', [
                'section' => 'nakes',
                'nakes_names' => ['Perawat', 'Bidan'],
                'nakes_values' => ['1,600 (50%)', '1,600 (50%)'],
                'nakes_widths' => ['50', '50'],
            ]);
        $response->assertRedirect('/admin/satu-data/statistik?section=nakes');

        // 4. Update Sebaran
        $response = $this->actingAs($admin)
            ->put('/admin/satu-data/statistik', [
                'section' => 'sebaran',
                'sebaran_names' => ['Zonasi Selatan', 'Zonasi Utara'],
                'sebaran_values' => ['25 Puskesmas (50%)', '25 Puskesmas (50%)'],
                'sebaran_widths' => ['50', '50'],
            ]);
        $response->assertRedirect('/admin/satu-data/statistik?section=sebaran');

        $this->assertDatabaseHas('statistik_settings', [
            'id' => 1,
            'stat_1_num' => '50',
            'stat_1_caption' => 'Akreditasi Paripurna Terjamin',
        ]);

        $this->assertDatabaseHas('stunting_records', [
            'year' => 2026,
            'rate' => 9.8,
            'is_highlighted' => true,
        ]);
    }
}
