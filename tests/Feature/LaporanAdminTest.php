<?php

namespace Tests\Feature;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LaporanAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_laporan(): void
    {
        $response = $this->get('/admin/satu-data/laporan');
        $response->assertRedirect('/dinkes-login');
    }

    public function test_admin_can_view_laporan_list(): void
    {
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);
        Laporan::create([
            'title' => 'Laporan Kinerja 2026',
            'category' => 'Laporan Kinerja',
            'file_path' => 'laporan/dummy.pdf',
            'file_size' => '1.2 MB',
            'release_date' => '2026-08-03',
        ]);

        $response = $this->actingAs($admin)->get('/admin/satu-data/laporan');

        $response->assertStatus(200);
        $response->assertSee('Laporan Kinerja 2026');
    }

    public function test_admin_can_create_laporan(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);
        $file = UploadedFile::fake()->create('laporan_tahunan.pdf', 500, 'application/pdf');

        $response = $this->actingAs($admin)->post('/admin/satu-data/laporan', [
            'title' => 'Laporan Keuangan Q1 2026',
            'category' => 'Laporan Keuangan',
            'file_document' => $file,
            'release_date' => '2026-08-03',
        ]);

        $response->assertRedirect(route('admin.laporan.index'));
        $this->assertDatabaseHas('laporans', [
            'title' => 'Laporan Keuangan Q1 2026',
            'category' => 'Laporan Keuangan',
        ]);

        // Check file exists in storage
        $laporan = Laporan::first();
        Storage::disk('public')->assertExists($laporan->file_path);
    }

    public function test_admin_can_update_laporan(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);
        $laporan = Laporan::create([
            'title' => 'Laporan Kinerja Awal',
            'category' => 'Laporan Kinerja',
            'file_path' => 'laporan/old.pdf',
            'file_size' => '1.0 MB',
            'release_date' => '2026-08-01',
        ]);

        $newFile = UploadedFile::fake()->create('laporan_baru.pdf', 600, 'application/pdf');

        $response = $this->actingAs($admin)->put("/admin/satu-data/laporan/{$laporan->id}", [
            'title' => 'Laporan Kinerja Diperbarui',
            'category' => 'Laporan Kinerja',
            'file_document' => $newFile,
            'release_date' => '2026-08-03',
        ]);

        $response->assertRedirect(route('admin.laporan.index'));
        $this->assertDatabaseHas('laporans', [
            'id' => $laporan->id,
            'title' => 'Laporan Kinerja Diperbarui',
        ]);

        // Old file deleted, new file exists
        Storage::disk('public')->assertMissing('laporan/old.pdf');
        $laporan->refresh();
        Storage::disk('public')->assertExists($laporan->file_path);
    }

    public function test_admin_can_delete_laporan(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);
        $laporan = Laporan::create([
            'title' => 'Laporan Untuk Dihapus',
            'category' => 'Laporan Kinerja',
            'file_path' => 'laporan/delete_me.pdf',
            'file_size' => '1.0 MB',
            'release_date' => '2026-08-01',
        ]);

        $response = $this->actingAs($admin)->delete("/admin/satu-data/laporan/{$laporan->id}");

        $response->assertRedirect(route('admin.laporan.index'));
        $this->assertDatabaseMissing('laporans', ['id' => $laporan->id]);
        Storage::disk('public')->assertMissing('laporan/delete_me.pdf');
    }
}
