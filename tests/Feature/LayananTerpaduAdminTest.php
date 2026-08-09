<?php

namespace Tests\Feature;

use App\Models\LayananTerpadu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LayananTerpaduAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_layanan_terpadu_renders_successful_response(): void
    {
        LayananTerpadu::create([
            'name' => 'Layanan Publik Cianjur Sehat',
            'type' => 'Warga',
            'icon' => 'smile',
            'link' => 'https://layanan.cianjurkab.go.id',
        ]);

        $response = $this->get('/layanan-terpadu');

        $response->assertStatus(200);
        $response->assertSee('Layanan Publik Cianjur Sehat');
    }

    public function test_public_layanan_terpadu_detail_renders_successful_response(): void
    {
        $service = LayananTerpadu::create([
            'name' => 'Layanan Detail Cianjur Sehat',
            'type' => 'Warga',
            'icon' => 'smile',
            'link' => 'https://layanan.cianjurkab.go.id',
            'description' => 'Ini adalah deskripsi detail pelayanan kesehatan di Cianjur.',
        ]);

        $response = $this->get("/layanan-terpadu/{$service->id}");

        $response->assertStatus(200);
        $response->assertSee('Layanan Detail Cianjur Sehat');
        $response->assertSee('Ini adalah deskripsi detail pelayanan kesehatan di Cianjur.');
    }

    public function test_guest_cannot_access_admin_layanan(): void
    {
        $response = $this->get('/admin/layanan-terpadu');
        $response->assertRedirect('/dinkes-login');
    }

    public function test_admin_can_view_layanan_list(): void
    {
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);
        LayananTerpadu::create([
            'name' => 'Layanan Tes Admin',
            'type' => 'Faskes',
            'icon' => 'desktop',
            'link' => null,
        ]);

        $response = $this->actingAs($admin)->get('/admin/layanan-terpadu');

        $response->assertStatus(200);
        $response->assertSee('Layanan Tes Admin');
    }

    public function test_admin_can_create_layanan(): void
    {
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);

        $response = $this->actingAs($admin)->post('/admin/layanan-terpadu', [
            'name' => 'Layanan BPJS Terpadu',
            'type' => 'Warga',
            'icon' => 'users',
            'link' => 'https://bpjs-kesehatan.go.id',
        ]);

        $response->assertRedirect(route('admin.layanan.index'));
        $this->assertDatabaseHas('layanan_terpadus', [
            'name' => 'Layanan BPJS Terpadu',
            'type' => 'Warga',
            'icon' => 'users',
            'link' => 'https://bpjs-kesehatan.go.id',
        ]);
    }

    public function test_admin_can_update_layanan(): void
    {
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);
        $layanan = LayananTerpadu::create([
            'name' => 'Layanan Lama',
            'type' => 'Nakes',
            'icon' => 'file',
            'link' => null,
        ]);

        $response = $this->actingAs($admin)->put("/admin/layanan-terpadu/{$layanan->id}", [
            'name' => 'Layanan Baru',
            'type' => 'Nakes',
            'icon' => 'users',
            'link' => 'https://nakes.kemkes.go.id',
        ]);

        $response->assertRedirect(route('admin.layanan.index'));
        $this->assertDatabaseHas('layanan_terpadus', [
            'id' => $layanan->id,
            'name' => 'Layanan Baru',
            'icon' => 'users',
        ]);
    }

    public function test_admin_can_delete_layanan(): void
    {
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);
        $layanan = LayananTerpadu::create([
            'name' => 'Layanan Hapus',
            'type' => 'Warga',
            'icon' => 'chat',
            'link' => null,
        ]);

        $response = $this->actingAs($admin)->delete("/admin/layanan-terpadu/{$layanan->id}");

        $response->assertRedirect(route('admin.layanan.index'));
        $this->assertDatabaseMissing('layanan_terpadus', ['id' => $layanan->id]);
    }
}
