<?php

namespace Tests\Feature;

use App\Models\ProgramKesehatan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgramKesehatanAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_program_renders_successful_response(): void
    {
        $program = ProgramKesehatan::create([
            'title' => 'Program Tuberkulosis (TB)',
            'slug' => 'program-tb',
            'subtitle' => 'Pencegahan TB di Cianjur',
            'stat_1_num' => '150',
            'stat_1_label' => 'Kasus Selesai',
            'content' => '<p>Artikel TB</p>',
            'intervensi' => [
                ['title' => 'Intervensi TB 1', 'description' => 'Detail 1'],
            ],
            'status' => 'published',
        ]);

        $response = $this->get('/program/program-tb');

        $response->assertStatus(200);
        $response->assertSee('Program Tuberkulosis (TB)');
        $response->assertSee('Pencegahan TB di Cianjur');
        $response->assertSee('150');
        $response->assertSee('Kasus Selesai');
        $response->assertSee('Intervensi TB 1');
    }

    public function test_public_program_redirects_old_paths(): void
    {
        ProgramKesehatan::create([
            'title' => 'Cianjur Bebas Stunting',
            'slug' => 'cianjur-bebas-stunting',
            'status' => 'published',
        ]);

        $response = $this->get('/cianjur-bebas-stunting');

        $response->assertRedirect('/program/cianjur-bebas-stunting');
    }

    public function test_draft_program_returns_404_for_guests(): void
    {
        $program = ProgramKesehatan::create([
            'title' => 'Program Draft',
            'slug' => 'program-draft',
            'status' => 'draft',
        ]);

        $response = $this->get('/program/program-draft');

        $response->assertStatus(404);
    }

    public function test_guest_cannot_access_admin_program(): void
    {
        $response = $this->get('/admin/program-kesehatan');
        $response->assertRedirect('/dinkes-login');
    }

    public function test_admin_can_view_program_list(): void
    {
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);
        ProgramKesehatan::create([
            'title' => 'Program List Test',
            'slug' => 'program-list-test',
            'status' => 'published',
        ]);

        $response = $this->actingAs($admin)->get('/admin/program-kesehatan');

        $response->assertStatus(200);
        $response->assertSee('Program List Test');
    }

    public function test_admin_can_create_program(): void
    {
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);

        $response = $this->actingAs($admin)->post('/admin/program-kesehatan', [
            'title' => 'Program Pencegahan DBD',
            'slug' => 'pencegahan-dbd',
            'subtitle' => 'Bersama berantas jentik nyamuk',
            'stat_1_num' => '24',
            'stat_1_label' => 'Kecamatan Terbebas',
            'content' => '<h3>Informasi DBD</h3>',
            'intervensi_titles' => ['Fogging Massal', '3M Plus'],
            'intervensi_descs' => ['Penyemprotan nyamuk', 'Mengubur menutup menguras'],
            'status' => 'published',
        ]);

        $response->assertRedirect(route('admin.program-kesehatan.index'));
        $this->assertDatabaseHas('program_kesehatans', [
            'title' => 'Program Pencegahan DBD',
            'slug' => 'pencegahan-dbd',
            'status' => 'published',
        ]);

        $program = ProgramKesehatan::where('slug', 'pencegahan-dbd')->first();
        $this->assertNotNull($program->intervensi);
        $this->assertCount(2, $program->intervensi);
        $this->assertEquals('Fogging Massal', $program->intervensi[0]['title']);
    }

    public function test_admin_can_update_program(): void
    {
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);
        $program = ProgramKesehatan::create([
            'title' => 'Program Lama',
            'slug' => 'program-lama',
            'status' => 'draft',
        ]);

        $response = $this->actingAs($admin)->put("/admin/program-kesehatan/{$program->id}", [
            'title' => 'Program Baru',
            'slug' => 'program-baru',
            'subtitle' => 'Subtitle Baru',
            'intervensi_titles' => ['Item Baru'],
            'intervensi_descs' => ['Desc Baru'],
            'status' => 'published',
        ]);

        $response->assertRedirect(route('admin.program-kesehatan.index'));
        $this->assertDatabaseHas('program_kesehatans', [
            'id' => $program->id,
            'title' => 'Program Baru',
            'slug' => 'program-baru',
            'status' => 'published',
        ]);
    }

    public function test_admin_can_delete_program(): void
    {
        $admin = User::factory()->create(['email' => 'admin@dinkes.go.id']);
        $program = ProgramKesehatan::create([
            'title' => 'Program Hapus',
            'slug' => 'program-hapus',
            'status' => 'published',
        ]);

        $response = $this->actingAs($admin)->delete("/admin/program-kesehatan/{$program->id}");

        $response->assertRedirect(route('admin.program-kesehatan.index'));
        $this->assertDatabaseMissing('program_kesehatans', ['id' => $program->id]);
    }
}
