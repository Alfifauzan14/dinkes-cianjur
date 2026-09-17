<?php

namespace Tests\Feature;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Faskes;
use App\Models\IkmRating;
use App\Models\Laporan;
use App\Models\PpidPermohonan;
use App\Models\Regulasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_renders_successfully_for_authenticated_admin(): void
    {
        $user = User::factory()->create([
            'is_admin' => true,
        ]);

        // Create dummy data for widgets
        Berita::create([
            'title' => 'Kabar Cianjur Sehat',
            'slug' => 'kabar-cianjur-sehat',
            'category' => 'Kesehatan',
            'content' => 'Lorem ipsum dolor sit amet.',
            'status' => 'published',
        ]);

        Agenda::create([
            'title' => 'Rapat Koordinasi Kesehatan',
            'date' => now()->addDays(2)->toDateString(),
            'time_start' => '09:00',
            'time_end' => '11:00',
            'location' => 'Aula Dinkes',
            'description' => 'Pembahasan program kesehatan',
            'status' => 'published',
        ]);

        Faskes::create([
            'name' => 'Puskesmas Cianjur Kota',
            'type' => 'Puskesmas',
            'kecamatan' => 'Cianjur',
            'address' => 'Jl. Kesehatan No. 1',
            'lat' => -6.82,
            'lng' => 107.14,
            'phone' => '0263123456',
        ]);

        Laporan::create([
            'title' => 'LAKIP 2025',
            'category' => 'Laporan Kinerja',
            'file_path' => 'laporan/dummy.pdf',
            'file_size' => '1.2 MB',
            'release_date' => '2025-01-01',
        ]);

        Regulasi::create([
            'title' => 'Perbup No. 42 Tahun 2024',
            'category' => 'PERATURAN BUPATI',
            'topic' => 'PERBUP STUNTING',
            'description' => 'Perbup penanggulangan stunting terpadu.',
            'year' => 2024,
            'file_path' => 'regulasi/documents/dummy.pdf',
            'file_size' => '2.4 MB',
            'status' => 'Berlaku',
        ]);

        PpidPermohonan::create([
            'nama_pemohon' => 'Budi Santoso',
            'nik' => '1234567890123456',
            'no_hp' => '08123456789',
            'email' => 'budi@example.com',
            'pekerjaan' => 'Swasta',
            'cara_memperoleh' => 'email',
            'alamat' => 'Cianjur',
            'foto_ktp' => 'ppid/ktp/dummy.jpg',
            'jenis_informasi' => 'anggaran',
            'tujuan_penggunaan' => 'penelitian',
            'rincian_informasi' => 'Rincian detail anggaran 2026',
            'status' => 'pending',
        ]);

        IkmRating::create([
            'name' => 'Warga 1',
            'whatsapp' => '081234567890',
            'rating' => 'sangat_puas',
            'description' => 'Sangat memuaskan',
        ]);

        IkmRating::create([
            'name' => 'Warga 2',
            'whatsapp' => '081234567891',
            'rating' => 'puas',
            'description' => 'Puas',
        ]);

        IkmRating::create([
            'name' => 'Warga 3',
            'whatsapp' => '081234567892',
            'rating' => 'cukup',
            'description' => 'Cukup baik',
        ]);

        IkmRating::create([
            'name' => 'Warga 4',
            'whatsapp' => '081234567893',
            'rating' => 'kurang',
            'description' => 'Perlu ditingkatkan',
        ]);

        $response = $this->actingAs($user)
            ->withSession(['gatekeeper_passed' => true])
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Selamat Datang');
        $response->assertSee('Kepuasan Masyarakat (IKM)');
        $response->assertSee('Sangat Puas');
        $response->assertSee('Kabar Cianjur Sehat');
        $response->assertSee('Budi Santoso');
    }

    public function test_admin_dashboard_renders_with_zero_ikm_records(): void
    {
        $user = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($user)
            ->withSession(['gatekeeper_passed' => true])
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Kepuasan Masyarakat (IKM)');
    }
}
