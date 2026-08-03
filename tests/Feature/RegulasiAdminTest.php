<?php

namespace Tests\Feature;

use App\Models\Regulasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RegulasiAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_regulasi(): void
    {
        $response = $this->get('/admin/satu-data/regulasi');
        $response->assertRedirect('/dinkes-login');
    }

    public function test_admin_can_view_regulasi_list(): void
    {
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);
        Regulasi::create([
            'title' => 'Perbup No. 42 Tahun 2024',
            'category' => 'PERATURAN BUPATI',
            'topic' => 'PERBUP STUNTING',
            'description' => 'Perbup penanggulangan stunting terpadu.',
            'year' => 2024,
            'cover_path' => null,
            'file_path' => 'regulasi/documents/dummy.pdf',
            'file_size' => '2.4 MB',
            'status' => 'Berlaku',
        ]);

        $response = $this->actingAs($admin)->get('/admin/satu-data/regulasi');

        $response->assertStatus(200);
        $response->assertSee('Perbup No. 42 Tahun 2024');
    }

    public function test_admin_can_create_regulasi(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);
        $cover = UploadedFile::fake()->image('cover.jpg');
        $file = UploadedFile::fake()->create('perbup.pdf', 800, 'application/pdf');

        $response = $this->actingAs($admin)->post('/admin/satu-data/regulasi', [
            'title' => 'Perbup No. 38 Tahun 2024',
            'category' => 'PERATURAN BUPATI',
            'topic' => 'KIA',
            'description' => 'Perbup tentang kesehatan ibu dan anak.',
            'year' => 2024,
            'file_cover' => $cover,
            'file_document' => $file,
            'status' => 'Berlaku',
        ]);

        $response->assertRedirect(route('admin.regulasi.index'));
        $this->assertDatabaseHas('regulasis', [
            'title' => 'Perbup No. 38 Tahun 2024',
            'topic' => 'KIA',
            'status' => 'Berlaku',
        ]);

        $regulasi = Regulasi::first();
        Storage::disk('public')->assertExists($regulasi->cover_path);
        Storage::disk('public')->assertExists($regulasi->file_path);
    }

    public function test_admin_can_update_regulasi(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);
        $regulasi = Regulasi::create([
            'title' => 'Perbup Awal',
            'category' => 'PERATURAN BUPATI',
            'topic' => 'GERMAS',
            'description' => 'Strategi germas.',
            'year' => 2023,
            'cover_path' => 'regulasi/covers/old.jpg',
            'file_path' => 'regulasi/documents/old.pdf',
            'file_size' => '1.5 MB',
            'status' => 'Berlaku',
        ]);

        $newCover = UploadedFile::fake()->image('new_cover.jpg');
        $newDoc = UploadedFile::fake()->create('new_perbup.pdf', 900, 'application/pdf');

        $response = $this->actingAs($admin)->put("/admin/satu-data/regulasi/{$regulasi->id}", [
            'title' => 'Perbup Diperbarui',
            'category' => 'PERATURAN BUPATI',
            'topic' => 'GERMAS',
            'description' => 'Strategi germas baru.',
            'year' => 2023,
            'file_cover' => $newCover,
            'file_document' => $newDoc,
            'status' => 'Berlaku',
        ]);

        $response->assertRedirect(route('admin.regulasi.index'));
        $this->assertDatabaseHas('regulasis', [
            'id' => $regulasi->id,
            'title' => 'Perbup Diperbarui',
        ]);

        // Old assets deleted, new ones exist
        Storage::disk('public')->assertMissing('regulasi/covers/old.jpg');
        Storage::disk('public')->assertMissing('regulasi/documents/old.pdf');

        $regulasi->refresh();
        Storage::disk('public')->assertExists($regulasi->cover_path);
        Storage::disk('public')->assertExists($regulasi->file_path);
    }

    public function test_admin_can_delete_regulasi(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);
        $regulasi = Regulasi::create([
            'title' => 'Perbup Untuk Dihapus',
            'category' => 'PERATURAN BUPATI',
            'topic' => 'KIA',
            'description' => 'Hapus ini.',
            'year' => 2022,
            'cover_path' => 'regulasi/covers/delete.jpg',
            'file_path' => 'regulasi/documents/delete.pdf',
            'file_size' => '1.0 MB',
            'status' => 'Berlaku',
        ]);

        $response = $this->actingAs($admin)->delete("/admin/satu-data/regulasi/{$regulasi->id}");

        $response->assertRedirect(route('admin.regulasi.index'));
        $this->assertDatabaseMissing('regulasis', ['id' => $regulasi->id]);
        Storage::disk('public')->assertMissing('regulasi/covers/delete.jpg');
        Storage::disk('public')->assertMissing('regulasi/documents/delete.pdf');
    }
}
