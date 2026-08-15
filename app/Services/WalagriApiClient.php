<?php

namespace App\Services;

/**
 * Standalone Client Library / SDK untuk integrasi aplikasi eksternal dengan Walagri Dashboard API.
 *
 * Dapat digunakan di framework PHP apapun (Laravel, Symfony, CodeIgniter, Native PHP, dll).
 */
class WalagriApiClient
{
    protected string $baseUrl;

    protected string $secretKey;

    protected int $timeout;

    protected bool $verifySsl;

    /**
     * @param  string  $baseUrl  Base URL server Walagri API (contoh: 'https://dashboard.medisy.id' atau 'http://127.0.0.1:9000')
     * @param  string  $secretKey  Secret key HMAC yang disepakati dengan server Walagri
     * @param  int  $timeout  Timeout HTTP request dalam detik (default: 10)
     */
    public function __construct(string $baseUrl, string $secretKey, int $timeout = 10, bool $verifySsl = true)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->secretKey = $secretKey;
        $this->timeout = $timeout;
        $this->verifySsl = $verifySsl;
    }

    /**
     * Helper factory untuk inisialisasi dari Environment Variables (opsional).
     */
    public static function createFromEnv(?string $baseUrl = null, ?string $secretKey = null, int $timeout = 10): self
    {
        $url = $baseUrl ?? env('WALAGRI_API_BASE_URL', config('app.url', 'http://127.0.0.1:8000'));
        $secret = $secretKey ?? env('WALAGRI_API_SECRET', '');
        $ssl = (bool) env('WALAGRI_API_VERIFY_SSL', true);

        return new self((string) $url, (string) $secret, $timeout, $ssl);
    }

    /**
     * Menghasilkan X-Api-Token dinamis berbasis timestamp HMAC SHA-256.
     */
    public function generateToken(?int $timestamp = null): string
    {
        $time = $timestamp ?? time();
        $signature = hash_hmac('sha256', (string) $time, $this->secretKey);

        return "{$time}.{$signature}";
    }

    /**
     * Mengirimkan request HTTP ke endpoint Walagri Dashboard API via cURL.
     */
    protected function request(string $endpoint, array $queryParams = []): array
    {
        $token = $this->generateToken();
        $url = $this->baseUrl.'/api/v1/dashboard/'.ltrim($endpoint, '/');

        if (! empty($queryParams)) {
            $url .= '?'.http_build_query($queryParams);
        }

        $ch = curl_init();
        $curlOptions = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'X-Api-Token: '.$token,
            ],
        ];
        if (! $this->verifySsl) {
            // ponytail: SSL bypass for local dev (Windows/XAMPP), set WALAGRI_API_VERIFY_SSL=true on production
            $curlOptions[CURLOPT_SSL_VERIFYPEER] = false;
            $curlOptions[CURLOPT_SSL_VERIFYHOST] = 0;
        }
        curl_setopt_array($ch, $curlOptions);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return [
                'success' => false,
                'message' => 'cURL Error: '.$error,
                'http_code' => 500,
            ];
        }

        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'success' => false,
                'message' => 'Response dari server bukan JSON valid',
                'raw_response' => $response,
                'http_code' => $httpCode,
            ];
        }

        return $data;
    }

    /**
     * Ambil Data Jumlah Kunjungan Pasien (General Metrics)
     *
     * @param  string|null  $startDate  Tanggal awal (Format: YYYY-MM-DD)
     * @param  string|null  $endDate  Tanggal akhir (Format: YYYY-MM-DD)
     * @param  int|array|null  $clientId  Filter Client ID faskes (opsional)
     */
    public function getPatientVisits(?string $startDate = null, ?string $endDate = null, $clientId = null): array
    {
        return $this->request('patient-visits', array_filter([
            'start_date' => $startDate,
            'end_date' => $endDate,
            'client_id' => $clientId,
        ], fn ($v) => ! is_null($v)));
    }

    /**
     * Ambil Data 10 Besar Penyakit
     *
     * @param  int  $limit  Jumlah data penyakit terbanyak (default: 10)
     * @param  string|null  $startDate  Tanggal awal (Format: YYYY-MM-DD)
     * @param  string|null  $endDate  Tanggal akhir (Format: YYYY-MM-DD)
     * @param  int|array|null  $clientId  Filter Client ID faskes (opsional)
     */
    public function getTopDiseases(int $limit = 10, ?string $startDate = null, ?string $endDate = null, $clientId = null): array
    {
        return $this->request('top-diseases', array_filter([
            'limit' => $limit,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'client_id' => $clientId,
        ], fn ($v) => ! is_null($v)));
    }

    /**
     * Ambil Data Status Pasien (UMUM / BPJS / Asuransi)
     *
     * @param  string|null  $gender  Filter gender ('male' atau 'female' atau null)
     * @param  string|null  $startDate  Tanggal awal (Format: YYYY-MM-DD)
     * @param  string|null  $endDate  Tanggal akhir (Format: YYYY-MM-DD)
     * @param  int|array|null  $clientId  Filter Client ID faskes (opsional)
     */
    public function getPatientStatus(?string $gender = null, ?string $startDate = null, ?string $endDate = null, $clientId = null): array
    {
        $endpoint = 'patient-status'.($gender ? '/'.$gender : '');

        return $this->request($endpoint, array_filter([
            'start_date' => $startDate,
            'end_date' => $endDate,
            'client_id' => $clientId,
        ], fn ($v) => ! is_null($v)));
    }

    /**
     * Ambil Data 10 Besar Pekerjaan Pasien
     *
     * @param  int  $limit  Jumlah data pekerjaan terbanyak (default: 10)
     * @param  string|null  $startDate  Tanggal awal (Format: YYYY-MM-DD)
     * @param  string|null  $endDate  Tanggal akhir (Format: YYYY-MM-DD)
     * @param  int|array|null  $clientId  Filter Client ID faskes (opsional)
     */
    public function getTopProfessions(int $limit = 10, ?string $startDate = null, ?string $endDate = null, $clientId = null): array
    {
        return $this->request('top-professions', array_filter([
            'limit' => $limit,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'client_id' => $clientId,
        ], fn ($v) => ! is_null($v)));
    }
}
