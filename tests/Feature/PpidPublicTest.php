<?php

namespace Tests\Feature;

use App\Models\PpidPermohonan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PpidPublicTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test cek status page renders successfully.
     */
    public function test_cek_status_page_renders_successfully(): void
    {
        $response = $this->get('/cek-status');
        $response->assertStatus(200);
        $response->assertSee('Cek Status Permohonan');
    }

    /**
     * Test cek status API returns permohonan data when token is valid.
     */
    public function test_cek_status_api_returns_correct_data_for_valid_token(): void
    {
        $perm = PpidPermohonan::create([
            'nama_pemohon' => 'Siti Rahma',
            'nik' => '3203010101010001',
            'no_hp' => '081234567890',
            'email' => 'siti@example.com',
            'pekerjaan' => 'PNS',
            'cara_memperoleh' => 'email',
            'alamat' => 'Jl. Merdeka No. 10, Cianjur',
            'foto_ktp' => 'ppid/ktp/ktp.jpg',
            'jenis_informasi' => 'program_kesehatan',
            'tujuan_penggunaan' => 'penelitian',
            'rincian_informasi' => 'Data stunting 2025',
            'status' => 'pending',
        ]);

        $response = $this->postJson('/cek-status', [
            'token' => $perm->token,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'found' => true,
            'data' => [
                'token' => $perm->token,
                'nama_pemohon' => 'Siti Rahma',
                'nik' => '3203010101010001',
                'status' => 'pending',
            ],
        ]);
    }

    /**
     * Test cek status API returns found false when token does not exist.
     */
    public function test_cek_status_api_returns_not_found_for_unknown_token(): void
    {
        $response = $this->postJson('/cek-status', [
            'token' => '9999999',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'found' => false,
            'message' => 'Token tidak ditemukan. Pastikan token yang dimasukkan benar.',
        ]);
    }

    /**
     * Test cek status API validation fails when token format is invalid.
     */
    public function test_cek_status_api_fails_when_token_format_is_invalid(): void
    {
        $response = $this->postJson('/cek-status', [
            'token' => 'ABC', // size must be 7
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['token']);
    }

    /**
     * Test keberatan page renders successfully.
     */
    public function test_keberatan_page_renders_successfully(): void
    {
        $response = $this->get('/keberatan');
        $response->assertStatus(200);
        $response->assertSee('Ajukan Keberatan');
    }

    /**
     * Test keberatan cek API returns matching data.
     */
    public function test_keberatan_cek_api_returns_data_for_valid_token_and_email(): void
    {
        $perm = PpidPermohonan::create([
            'nama_pemohon' => 'Ahmad Dahlan',
            'nik' => '3203010101010002',
            'no_hp' => '081234567891',
            'email' => 'ahmad@example.com',
            'pekerjaan' => 'Wiraswasta',
            'cara_memperoleh' => 'email',
            'alamat' => 'Cianjur Kota',
            'foto_ktp' => 'ppid/ktp/ktp.jpg',
            'jenis_informasi' => 'anggaran',
            'tujuan_penggunaan' => 'penelitian',
            'rincian_informasi' => 'Rincian anggaran',
            'status' => 'ditolak',
        ]);

        $response = $this->postJson('/keberatan/cek', [
            'token' => $perm->token,
            'email' => 'ahmad@example.com',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'found' => true,
            'data' => [
                'nama_pemohon' => 'Ahmad Dahlan',
                'status' => 'ditolak',
            ],
        ]);
    }

    /**
     * Test keberatan cek API returns not found when email is incorrect.
     */
    public function test_keberatan_cek_api_fails_with_wrong_email(): void
    {
        $perm = PpidPermohonan::create([
            'nama_pemohon' => 'Ahmad Dahlan',
            'nik' => '3203010101010002',
            'no_hp' => '081234567891',
            'email' => 'ahmad@example.com',
            'pekerjaan' => 'Wiraswasta',
            'cara_memperoleh' => 'email',
            'alamat' => 'Cianjur Kota',
            'foto_ktp' => 'ppid/ktp/ktp.jpg',
            'jenis_informasi' => 'anggaran',
            'tujuan_penggunaan' => 'penelitian',
            'rincian_informasi' => 'Rincian anggaran',
            'status' => 'ditolak',
        ]);

        $response = $this->postJson('/keberatan/cek', [
            'token' => $perm->token,
            'email' => 'wrong@example.com',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'found' => false,
        ]);
    }

    /**
     * Test submitting keberatan stores record successfully.
     */
    public function test_submit_keberatan_successfully(): void
    {
        $perm = PpidPermohonan::create([
            'nama_pemohon' => 'Ahmad Dahlan',
            'nik' => '3203010101010002',
            'no_hp' => '081234567891',
            'email' => 'ahmad@example.com',
            'pekerjaan' => 'Wiraswasta',
            'cara_memperoleh' => 'email',
            'alamat' => 'Cianjur Kota',
            'foto_ktp' => 'ppid/ktp/ktp.jpg',
            'jenis_informasi' => 'anggaran',
            'tujuan_penggunaan' => 'penelitian',
            'rincian_informasi' => 'Rincian anggaran',
            'status' => 'ditolak',
        ]);

        $response = $this->post('/keberatan', [
            'token' => $perm->token,
            'email' => 'ahmad@example.com',
            'alasan_keberatan' => 'Permohonan ditolak tanpa alasan yang jelas sesuai UU KIP.',
        ]);

        $response->assertRedirect('/keberatan');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('ppid_keberatans', [
            'permohonan_id' => $perm->id,
            'token' => $perm->token,
            'email' => 'ahmad@example.com',
            'alasan_keberatan' => 'Permohonan ditolak tanpa alasan yang jelas sesuai UU KIP.',
            'status' => 'pending',
        ]);
    }

    /**
     * Test submit keberatan fails if token and email mismatch.
     */
    public function test_submit_keberatan_fails_when_token_or_email_invalid(): void
    {
        $response = $this->post('/keberatan', [
            'token' => '9999999',
            'email' => 'nonexistent@example.com',
            'alasan_keberatan' => 'Alasan keberatan saya.',
        ]);

        $response->assertSessionHasErrors(['token']);
    }
}
