<?php

namespace Tests\Feature;

use App\Models\Agenda;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AgendaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test public agenda calendar page.
     */
    public function test_public_agenda_returns_successful_response(): void
    {
        $response = $this->get('/agenda');
        $response->assertStatus(200);
    }

    /**
     * Test public agenda AJAX endpoint by date.
     */
    public function test_public_agenda_ajax_endpoint_returns_json(): void
    {
        Agenda::create([
            'title' => 'Rapat Evaluasi Dinkes',
            'date' => '2026-08-04',
            'time_start' => '09:00',
            'time_end' => '11:00',
            'location' => 'Kantor Dinkes',
            'description' => 'Evaluasi program bulanan.',
            'status' => 'published',
        ]);

        $response = $this->getJson('/api/agenda-by-date?agenda_date=2026-08-04');
        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * Test admin agenda page redirects when guest.
     */
    public function test_guest_cannot_access_admin_agenda(): void
    {
        $response = $this->get('/admin/agenda');
        $response->assertRedirect('/dinkes-login');
    }

    /**
     * Test admin can view agenda list.
     */
    public function test_admin_can_view_agenda_list(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $agenda = Agenda::create([
            'title' => 'Rapat Koordinasi Bulanan',
            'date' => '2026-08-05',
            'time_start' => '09:00',
            'time_end' => '11:00',
            'location' => 'Aula Dinkes',
            'description' => 'Membahas program kerja bulanan.',
            'status' => 'published',
        ]);

        $response = $this->actingAs($admin)
            ->get('/admin/agenda');

        $response->assertStatus(200);
        $response->assertSee('Rapat Koordinasi Bulanan');
    }

    /**
     * Test admin can search agenda by keywords and natural dates.
     */
    public function test_admin_can_search_agenda_by_date_and_keywords(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        Agenda::create([
            'title' => 'Rapat Sosialisasi Stunting',
            'date' => '2026-08-20',
            'time_start' => '08:00',
            'time_end' => '10:00',
            'location' => 'Puskesmas Cikalong',
            'status' => 'published',
        ]);

        // Search by location
        $res1 = $this->actingAs($admin)->get('/admin/agenda?search=Cikalong');
        $res1->assertSee('Rapat Sosialisasi Stunting');

        // Search by numeric date
        $res2 = $this->actingAs($admin)->get('/admin/agenda?search=20-08-2026');
        $res2->assertSee('Rapat Sosialisasi Stunting');

        // Search by Indonesian date
        $res3 = $this->actingAs($admin)->get('/admin/agenda?search=20+Agustus');
        $res3->assertSee('Rapat Sosialisasi Stunting');
    }

    /**
     * Test admin can create agenda.
     */
    public function test_admin_can_create_agenda(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $response = $this->actingAs($admin)
            ->post('/admin/agenda', [
                'title' => 'Sosialisasi Gizi Sehat',
                'date' => '2026-08-10',
                'time_start' => '10:00',
                'time_end' => '12:00',
                'location' => 'Aula Puskesmas',
                'description' => 'Sosialisasi gizi buruk bagi ibu hamil.',
                'status' => 'published',
            ]);

        $response->assertRedirect(route('admin.agenda.index'));
        $this->assertDatabaseHas('agendas', [
            'title' => 'Sosialisasi Gizi Sehat',
            'location' => 'Aula Puskesmas',
        ]);
    }

    /**
     * Test admin can update agenda.
     */
    public function test_admin_can_update_agenda(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $agenda = Agenda::create([
            'title' => 'Agenda Awal',
            'date' => '2026-08-15',
            'time_start' => '08:00',
            'time_end' => '10:00',
            'location' => 'Kantor Dinkes',
            'description' => 'Rapat awal.',
            'status' => 'draft',
        ]);

        $response = $this->actingAs($admin)
            ->put("/admin/agenda/{$agenda->id}", [
                'title' => 'Agenda Diperbarui',
                'date' => '2026-08-15',
                'time_start' => '08:30',
                'time_end' => '10:30',
                'location' => 'Ruang Kepala Dinas',
                'description' => 'Rapat revisi.',
                'status' => 'published',
            ]);

        $response->assertRedirect(route('admin.agenda.index'));
        $this->assertDatabaseHas('agendas', [
            'id' => $agenda->id,
            'title' => 'Agenda Diperbarui',
            'location' => 'Ruang Kepala Dinas',
            'status' => 'published',
        ]);
    }

    /**
     * Test admin can delete agenda.
     */
    public function test_admin_can_delete_agenda(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $agenda = Agenda::create([
            'title' => 'Agenda Dihapus',
            'date' => '2026-08-20',
            'time_start' => '09:00',
            'time_end' => '10:00',
            'location' => 'Puskesmas',
            'status' => 'published',
        ]);

        $response = $this->actingAs($admin)
            ->delete("/admin/agenda/{$agenda->id}");

        $response->assertRedirect(route('admin.agenda.index'));
        $this->assertDatabaseMissing('agendas', [
            'id' => $agenda->id,
        ]);
    }

    /**
     * Test draft agendas are hidden from public views.
     */
    public function test_draft_agendas_are_hidden_from_public_views(): void
    {
        // Published future agenda
        $publishedAgenda = Agenda::create([
            'title' => 'Agenda Publik Masa Depan',
            'date' => now()->addDay()->format('Y-m-d'),
            'time_start' => '08:00',
            'time_end' => '10:00',
            'location' => 'Aula',
            'status' => 'published',
        ]);

        // Draft future agenda
        $draftAgenda = Agenda::create([
            'title' => 'Agenda Draf Rahasia',
            'date' => now()->addDay()->format('Y-m-d'),
            'time_start' => '09:00',
            'time_end' => '11:00',
            'location' => 'Aula Depan',
            'status' => 'draft',
        ]);

        // 1. Check landing page date navigation
        $response = $this->get('/?agenda_date='.now()->addDay()->format('Y-m-d'));
        $response->assertSee('Agenda Publik Masa Depan');
        $response->assertDontSee('Agenda Draf Rahasia');

        // 2. Check public calendar page
        $response2 = $this->get('/agenda?month='.now()->month.'&year='.now()->year.'&date='.now()->addDay()->format('Y-m-d'));
        $response2->assertSee('Agenda Publik Masa Depan');
        $response2->assertDontSee('Agenda Draf Rahasia');
    }

    /**
     * Test admin can view import form.
     */
    public function test_admin_can_view_import_form(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $response = $this->actingAs($admin)
            ->get(route('admin.agenda.import_form'));

        $response->assertStatus(200);
        $response->assertSee('Impor Agenda via CSV');
    }

    /**
     * Test admin can import agendas via CSV.
     */
    public function test_admin_can_import_agenda_csv(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
        ]);

        $csvContent = "title,date,time_start,time_end,location,description,status\n".
                      "Agenda Impor 1,2026-08-05,09:00,11:00,Aula Utama,Deskripsi impor 1,published\n".
                      "Agenda Impor 2,2026-08-06,10:00,12:00,Aula Kecil,Deskripsi impor 2,draft\n";

        $file = UploadedFile::fake()->createWithContent('agendas.csv', $csvContent);

        $response = $this->actingAs($admin)
            ->post(route('admin.agenda.import'), [
                'csv_file' => $file,
            ]);

        $response->assertRedirect(route('admin.agenda.index'));
        $this->assertDatabaseHas('agendas', [
            'title' => 'Agenda Impor 1',
            'location' => 'Aula Utama',
            'status' => 'published',
        ]);
        $this->assertDatabaseHas('agendas', [
            'title' => 'Agenda Impor 2',
            'location' => 'Aula Kecil',
            'status' => 'draft',
        ]);
    }
}
