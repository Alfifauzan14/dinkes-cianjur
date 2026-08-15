<?php

namespace Tests\Feature;

use App\Mail\PpidTanggapanMail;
use App\Models\PpidPermohonan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PpidAdminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest cannot access PPID permohonan list.
     */
    public function test_guest_cannot_access_ppid_permohonan(): void
    {
        $response = $this->get('/admin/ppid-permohonan');
        $response->assertRedirect('/dinkes-login');
    }

    /**
     * Test admin can view PPID permohonan list page.
     */
    public function test_admin_can_view_ppid_permohonan_page(): void
    {
        $admin = User::factory()->create();
        PpidPermohonan::create([
            'nama_pemohon' => 'Budi Santoso',
            'nik' => '1234567890123456',
            'no_hp' => '08123456789',
            'pekerjaan' => 'Swasta',
            'cara_memperoleh' => 'email',
            'alamat' => 'Cianjur',
            'foto_ktp' => 'ppid/ktp/dummy.jpg',
            'jenis_informasi' => 'anggaran',
            'tujuan_penggunaan' => 'penelitian',
            'rincian_informasi' => 'Rincian detail anggaran 2026',
        ]);

        $response = $this->actingAs($admin)->get('/admin/ppid-permohonan');
        $response->assertStatus(200);
        $response->assertSee('Budi Santoso');
        $response->assertSee('Anggaran');
    }

    /**
     * Test admin can view PPID permohonan detail.
     */
    public function test_admin_can_view_ppid_permohonan_detail(): void
    {
        $admin = User::factory()->create();
        $perm = PpidPermohonan::create([
            'nama_pemohon' => 'Budi Santoso',
            'nik' => '1234567890123456',
            'no_hp' => '08123456789',
            'pekerjaan' => 'Swasta',
            'cara_memperoleh' => 'email',
            'alamat' => 'Cianjur',
            'foto_ktp' => 'ppid/ktp/dummy.jpg',
            'jenis_informasi' => 'anggaran',
            'tujuan_penggunaan' => 'penelitian',
            'rincian_informasi' => 'Rincian detail anggaran 2026',
        ]);

        $response = $this->actingAs($admin)->get("/admin/ppid-permohonan/{$perm->id}");
        $response->assertStatus(200);
        $response->assertSee('Identitas Pemohon');
        $response->assertSee('1234567890123456');
    }

    /**
     * Test admin can update status of PPID permohonan.
     */
    public function test_admin_can_update_status_of_permohonan(): void
    {
        $admin = User::factory()->create();
        $perm = PpidPermohonan::create([
            'nama_pemohon' => 'Budi Santoso',
            'nik' => '1234567890123456',
            'no_hp' => '08123456789',
            'pekerjaan' => 'Swasta',
            'cara_memperoleh' => 'email',
            'alamat' => 'Cianjur',
            'foto_ktp' => 'ppid/ktp/dummy.jpg',
            'jenis_informasi' => 'anggaran',
            'tujuan_penggunaan' => 'penelitian',
            'rincian_informasi' => 'Rincian detail anggaran 2026',
        ]);

        $response = $this->actingAs($admin)->put("/admin/ppid-permohonan/{$perm->id}/status", [
            'status' => 'disetujui',
            'tanggapan' => 'Permohonan lengkap dan disetujui.',
        ]);

        $response->assertRedirect("/admin/ppid-permohonan/{$perm->id}");
        $response->assertSessionHas('success', 'Status permohonan berhasil diperbarui. (Email tidak dikirim karena pemohon tidak mencantumkan email)');

        $this->assertDatabaseHas('ppid_permohonans', [
            'id' => $perm->id,
            'status' => 'disetujui',
            'tanggapan' => 'Permohonan lengkap dan disetujui.',
        ]);
    }

    /**
     * Test admin can update status and send email with document attachment.
     */
    public function test_admin_can_update_status_and_send_email_with_file(): void
    {
        Mail::fake();
        Storage::fake('public');

        $admin = User::factory()->create();
        $perm = PpidPermohonan::create([
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
        ]);

        $file = UploadedFile::fake()->create('dokumen_response.pdf', 500); // 500KB

        $response = $this->actingAs($admin)->put("/admin/ppid-permohonan/{$perm->id}/status", [
            'status' => 'disetujui',
            'tanggapan' => 'Berikut adalah dokumen yang diminta.',
            'file_tanggapan' => $file,
        ]);

        $response->assertRedirect("/admin/ppid-permohonan/{$perm->id}");
        $response->assertSessionHas('success', 'Status permohonan berhasil diperbarui dan email tanggapan telah dikirim ke pemohon.');

        $perm->refresh();
        $this->assertNotNull($perm->file_tanggapan);
        $this->assertTrue(Storage::disk('public')->exists($perm->file_tanggapan));

        $this->assertDatabaseHas('ppid_permohonans', [
            'id' => $perm->id,
            'status' => 'disetujui',
            'tanggapan' => 'Berikut adalah dokumen yang diminta.',
        ]);

        Mail::assertSent(PpidTanggapanMail::class, function ($mail) use ($perm) {
            return $mail->hasTo('budi@example.com') &&
                   $mail->permohonan->id === $perm->id;
        });
    }

    /**
     * Test public can submit permohonan successfully under 10MB limit.
     */
    public function test_public_can_submit_permohonan_successfully(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('ktp.jpg')->size(5000); // 5MB

        $response = $this->post('/permohonan', [
            'nama_pemohon' => 'Budi Santoso',
            'nik' => '1234567890123456',
            'no_hp' => '08123456789',
            'email' => 'budi@example.com',
            'pekerjaan' => 'Swasta',
            'cara_memperoleh' => 'email',
            'alamat' => 'Cianjur',
            'foto_ktp' => $file,
            'jenis_informasi' => 'anggaran',
            'tujuan_penggunaan' => 'penelitian',
            'rincian_informasi' => 'Rincian detail anggaran 2026',
            'format_informasi' => ['softcopy'],
            'persetujuan' => '1',
        ]);

        $response->assertRedirect('/permohonan');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('ppid_permohonans', [
            'nama_pemohon' => 'Budi Santoso',
            'nik' => '1234567890123456',
        ]);

        $perm = PpidPermohonan::first();
        $this->assertTrue(Storage::disk('public')->exists($perm->foto_ktp));
    }

    /**
     * Test public submission fails when KTP file exceeds 10MB.
     */
    public function test_public_submission_fails_when_file_exceeds_10mb(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('large_ktp.jpg')->size(11000); // 11MB (exceeds 10240 KB limit)

        $response = $this->post('/permohonan', [
            'nama_pemohon' => 'Budi Santoso',
            'nik' => '1234567890123456',
            'no_hp' => '08123456789',
            'pekerjaan' => 'Swasta',
            'cara_memperoleh' => 'email',
            'alamat' => 'Cianjur',
            'foto_ktp' => $file,
            'jenis_informasi' => 'anggaran',
            'tujuan_penggunaan' => 'penelitian',
            'rincian_informasi' => 'Rincian detail anggaran 2026',
            'format_informasi' => ['softcopy'],
            'persetujuan' => '1',
        ]);

        $response->assertSessionHasErrors(['foto_ktp']);
    }
}
