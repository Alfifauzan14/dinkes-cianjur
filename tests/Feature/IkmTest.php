<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IkmTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test ikm index page renders successfully.
     */
    public function test_ikm_page_renders_successfully(): void
    {
        $response = $this->get('/ikm');

        $response->assertStatus(200);
        $response->assertSee('Indeks Kepuasan Masyarakat');
        $response->assertSee('Saya bukan robot');
    }

    /**
     * Test ikm form validation fails when recaptcha or rating is missing.
     */
    public function test_ikm_store_validation_fails_without_rating_or_recaptcha(): void
    {
        $response = $this->post('/ikm', [
            'name' => 'John Doe',
            'whatsapp' => '08123456789',
        ]);

        $response->assertSessionHasErrors(['rating', 'g-recaptcha-response']);
    }

    /**
     * Test ikm submission succeeds with valid rating and recaptcha response in test environment.
     */
    public function test_ikm_submission_succeeds(): void
    {
        $response = $this->post('/ikm', [
            'name' => 'Asep',
            'whatsapp' => '081234567890',
            'rating' => 'sangat_puas',
            'description' => 'Pelayanan sangat cepat dan ramah.',
            'g-recaptcha-response' => 'test-token',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('ikm_ratings', [
            'name' => 'Asep',
            'rating' => 'sangat_puas',
        ]);
    }
}
