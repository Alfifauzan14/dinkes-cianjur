<?php

namespace Tests\Feature;

use App\Models\Infografis;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class InfografisTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test public infografis page returns successful response.
     */
    public function test_public_infografis_returns_successful_response(): void
    {
        $response = $this->get('/media/infografis');
        $response->assertStatus(200);
    }

    /**
     * Test guest cannot access admin infografis.
     */
    public function test_guest_cannot_access_admin_infografis(): void
    {
        $response = $this->get('/admin/infografis');
        $response->assertRedirect('/dinkes-login');
    }

    /**
     * Test admin can view infografis list.
     */
    public function test_admin_can_view_infografis_list(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $item = Infografis::create([
            'title' => 'Poster Cuci Tangan Pakai Sabun',
            'image' => 'poster.jpg',
        ]);

        $response = $this->actingAs($admin)->get('/admin/infografis');
        $response->assertStatus(200);
        $response->assertSee('Poster Cuci Tangan Pakai Sabun');
    }

    /**
     * Test admin can create infografis.
     */
    public function test_admin_can_create_infografis(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $file = UploadedFile::fake()->image('infografis_new.jpg');

        $response = $this->actingAs($admin)->post('/admin/infografis', [
            'title' => 'Infografis Pencegahan Stunting',
            'image' => $file,
        ]);

        $response->assertRedirect(route('admin.infografis.index'));
        $this->assertDatabaseHas('infografis', [
            'title' => 'Infografis Pencegahan Stunting',
        ]);

        // Cleanup fake uploaded file if created
        $created = Infografis::where('title', 'Infografis Pencegahan Stunting')->first();
        if ($created && File::exists(public_path('uploads/infografis/'.$created->image))) {
            File::delete(public_path('uploads/infografis/'.$created->image));
        }
    }

    /**
     * Test admin can update infografis.
     */
    public function test_admin_can_update_infografis(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $item = Infografis::create([
            'title' => 'Judul Awal',
            'image' => 'initial.jpg',
        ]);

        $response = $this->actingAs($admin)->put("/admin/infografis/{$item->id}", [
            'title' => 'Judul Diperbarui',
        ]);

        $response->assertRedirect(route('admin.infografis.index'));
        $this->assertDatabaseHas('infografis', [
            'id' => $item->id,
            'title' => 'Judul Diperbarui',
        ]);
    }

    /**
     * Test admin can delete infografis.
     */
    public function test_admin_can_delete_infografis(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $item = Infografis::create([
            'title' => 'Infografis Dihapus',
            'image' => 'delete_me.jpg',
        ]);

        $response = $this->actingAs($admin)->delete("/admin/infografis/{$item->id}");

        $response->assertRedirect(route('admin.infografis.index'));
        $this->assertDatabaseMissing('infografis', [
            'id' => $item->id,
        ]);
    }
}
