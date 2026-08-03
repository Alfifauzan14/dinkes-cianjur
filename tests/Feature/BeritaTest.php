<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BeritaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test public welcome page has news list.
     */
    public function test_public_welcome_page_has_news(): void
    {
        $berita = Berita::create([
            'title' => 'Kabar Cianjur Sehat',
            'slug' => 'kabar-cianjur-sehat',
            'category' => 'Kesehatan',
            'content' => 'Lorem ipsum dolor sit amet.',
            'status' => 'published',
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Kabar Cianjur Sehat');
    }

    /**
     * Test public news index and detail pages.
     */
    public function test_public_news_pages(): void
    {
        $berita = Berita::create([
            'title' => 'Kabar Kesehatan Cianjur',
            'slug' => 'kabar-kesehatan-cianjur',
            'category' => 'Kesehatan',
            'content' => 'Detail content of berita.',
            'status' => 'published',
        ]);

        $response = $this->get('/berita');
        $response->assertStatus(200);
        $response->assertSee('Kabar Kesehatan Cianjur');

        $responseShow = $this->get('/berita/kabar-kesehatan-cianjur');
        $responseShow->assertStatus(200);
        $responseShow->assertSee('Detail content of berita.');
    }

    /**
     * Test guest cannot access admin news page.
     */
    public function test_guest_cannot_access_admin_news(): void
    {
        $response = $this->get('/admin/berita');
        $response->assertRedirect('/dinkes-login');
    }

    /**
     * Test admin can manage news.
     */
    public function test_admin_can_manage_news(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        // 1. Create News
        $responseCreate = $this->actingAs($admin)
            ->post('/admin/berita', [
                'title' => 'Acara Imunisasi Balita',
                'category' => 'Kegiatan',
                'content' => 'Isi berita acara imunisasi lengkap.',
                'status' => 'published',
            ]);

        $responseCreate->assertRedirect(route('admin.berita.index'));
        $this->assertDatabaseHas('beritas', [
            'title' => 'Acara Imunisasi Balita',
        ]);

        $berita = Berita::where('title', 'Acara Imunisasi Balita')->first();

        // 2. Access Edit Page
        $responseEdit = $this->actingAs($admin)
            ->get("/admin/berita/{$berita->id}/edit");
        $responseEdit->assertStatus(200);
        $responseEdit->assertSee('Acara Imunisasi Balita');

        // 3. Update News
        $responseUpdate = $this->actingAs($admin)
            ->put("/admin/berita/{$berita->id}", [
                'title' => 'Acara Imunisasi Balita Cianjur',
                'category' => 'Kegiatan',
                'content' => 'Isi berita acara imunisasi diperbarui.',
                'status' => 'published',
            ]);

        $responseUpdate->assertRedirect(route('admin.berita.index'));
        $this->assertDatabaseHas('beritas', [
            'id' => $berita->id,
            'title' => 'Acara Imunisasi Balita Cianjur',
        ]);

        // 4. Delete News
        $responseDelete = $this->actingAs($admin)
            ->delete("/admin/berita/{$berita->id}");

        $responseDelete->assertRedirect(route('admin.berita.index'));
        $this->assertDatabaseMissing('beritas', [
            'id' => $berita->id,
        ]);
    }
}
