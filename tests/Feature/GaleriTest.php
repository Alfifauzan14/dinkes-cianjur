<?php

namespace Tests\Feature;

use App\Models\Galeri;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GaleriTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test public media gallery returns successful response.
     */
    public function test_public_media_returns_successful_response(): void
    {
        $response = $this->get('/media');
        $response->assertStatus(200);
    }

    /**
     * Test admin gallery page redirects when guest.
     */
    public function test_guest_cannot_access_admin_galeri(): void
    {
        $response = $this->get('/admin/galeri');
        $response->assertRedirect('/dinkes-login');
    }

    /**
     * Test admin can view gallery list.
     */
    public function test_admin_can_view_galeri_list(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $galeri = Galeri::create([
            'title' => 'Foto Kegiatan Imunisasi',
            'image' => 'logo.png',
            'category' => 'PROGRAM',
        ]);

        $response = $this->actingAs($admin)
            ->get('/admin/galeri');

        $response->assertStatus(200);
        $response->assertSee('Foto Kegiatan Imunisasi');
    }

    /**
     * Test admin can update gallery.
     */
    public function test_admin_can_update_galeri(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $galeri = Galeri::create([
            'title' => 'Foto Awal',
            'image' => 'logo.png',
            'category' => 'PROGRAM',
        ]);

        $response = $this->actingAs($admin)
            ->put("/admin/galeri/{$galeri->id}", [
                'title' => 'Foto Diperbarui',
                'category' => 'KEGIATAN',
            ]);

        $response->assertRedirect(route('admin.galeri.index'));
        $this->assertDatabaseHas('galeris', [
            'id' => $galeri->id,
            'title' => 'Foto Diperbarui',
            'category' => 'KEGIATAN',
        ]);
    }

    /**
     * Test admin can delete gallery.
     */
    public function test_admin_can_delete_galeri(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $galeri = Galeri::create([
            'title' => 'Foto Dihapus',
            'image' => 'logo.png',
            'category' => 'PROGRAM',
        ]);

        $response = $this->actingAs($admin)
            ->delete("/admin/galeri/{$galeri->id}");

        $response->assertRedirect(route('admin.galeri.index'));
        $this->assertDatabaseMissing('galeris', [
            'id' => $galeri->id,
        ]);
    }
}
