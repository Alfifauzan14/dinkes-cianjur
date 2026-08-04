<?php

namespace Tests\Feature;

use App\Models\Faskes;
use App\Models\JenisFaskes;
use App\Models\Kecamatan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FaskesAdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest cannot access admin faskes.
     */
    public function test_guest_cannot_access_faskes_admin(): void
    {
        $this->get('/admin/faskes')->assertRedirect('/dinkes-login');
        $this->get('/admin/jenis-faskes')->assertRedirect('/dinkes-login');
        $this->get('/admin/kecamatan')->assertRedirect('/dinkes-login');
    }

    /**
     * Test admin can view faskes, jenis-faskes, and kecamatan lists.
     */
    public function test_admin_can_view_faskes_lists(): void
    {
        $admin = User::factory()->create();

        JenisFaskes::create(['name' => 'Puskesmas']);
        Kecamatan::create(['name' => 'Cianjur']);

        $this->actingAs($admin)->get('/admin/faskes')->assertStatus(200)->assertSee('Tambah Faskes');
        $this->actingAs($admin)->get('/admin/jenis-faskes')->assertStatus(200)->assertSee('Puskesmas');
        $this->actingAs($admin)->get('/admin/kecamatan')->assertStatus(200)->assertSee('Cianjur');
    }

    /**
     * Test admin can manage faskes records.
     */
    public function test_admin_can_manage_faskes(): void
    {
        $admin = User::factory()->create();

        JenisFaskes::create(['name' => 'Puskesmas']);
        Kecamatan::create(['name' => 'Cianjur']);

        // Create Faskes
        $response = $this->actingAs($admin)->post('/admin/faskes', [
            'name' => 'Puskesmas Cianjur Kota',
            'type' => 'Puskesmas',
            'kecamatan' => 'Cianjur',
            'address' => 'Jl. Kesehatan No. 12',
            'lat' => -6.82,
            'lng' => 107.14,
        ]);

        $response->assertRedirect('/admin/faskes');
        $this->assertDatabaseHas('faskes', ['name' => 'Puskesmas Cianjur Kota']);

        $faskes = Faskes::first();

        // Update Faskes
        $response = $this->actingAs($admin)->put("/admin/faskes/{$faskes->id}", [
            'name' => 'Puskesmas Cianjur Updated',
            'type' => 'Puskesmas',
            'kecamatan' => 'Cianjur',
            'address' => 'Jl. Kesehatan No. 12',
            'lat' => -6.82,
            'lng' => 107.14,
        ]);
        $response->assertRedirect('/admin/faskes');
        $this->assertDatabaseHas('faskes', ['name' => 'Puskesmas Cianjur Updated']);

        // Delete Faskes
        $response = $this->actingAs($admin)->delete("/admin/faskes/{$faskes->id}");
        $response->assertRedirect('/admin/faskes');
        $this->assertDatabaseMissing('faskes', ['id' => $faskes->id]);
    }

    /**
     * Test admin can import and export Faskes CSV.
     */
    public function test_admin_can_import_and_export_faskes_csv(): void
    {
        $admin = User::factory()->create();

        // Export Faskes CSV (returns stream)
        $response = $this->actingAs($admin)->get('/admin/faskes-export');
        $response->assertStatus(200);
        $this->assertStringContainsString('text/csv', $response->headers->get('Content-Type'));

        // Prepare CSV File content
        $csvContent = "name,type,kecamatan,address,phone,jam_operasional,lat,lng,layanan,akreditasi\n"
                    . "Klinik Harapan,Klinik Swasta,Cibeber,Jl. Cibeber No. 5,,,-6.85,107.15,General,Madya\n";

        $tempFile = tempnam(sys_get_temp_dir(), 'faskes_test');
        file_put_contents($tempFile, $csvContent);

        $uploadedFile = new UploadedFile(
            $tempFile,
            'faskes.csv',
            'text/csv',
            null,
            true
        );

        $response = $this->actingAs($admin)->post('/admin/faskes-import', [
            'csv_file' => $uploadedFile,
        ]);

        $response->assertRedirect('/admin/faskes');
        $this->assertDatabaseHas('faskes', [
            'name' => 'Klinik Harapan',
            'type' => 'Klinik Swasta',
            'kecamatan' => 'Cibeber',
        ]);
        $this->assertDatabaseHas('jenis_faskes', ['name' => 'Klinik Swasta']);
        $this->assertDatabaseHas('kecamatans', ['name' => 'Cibeber']);

        @unlink($tempFile);
    }
}
