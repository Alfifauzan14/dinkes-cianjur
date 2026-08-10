<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthSecurityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Config::set('services.gatekeeper.username', 'admin_test');
        Config::set('services.gatekeeper.password', 'secret_gatekeeper_123');
    }

    public function test_gatekeeper_verification_successful(): void
    {
        $response = $this->postJson(route('gatekeeper.verify'), [
            'username' => 'admin_test',
            'password' => 'secret_gatekeeper_123',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertTrue(session('gatekeeper_passed'));
    }

    public function test_gatekeeper_verification_failed(): void
    {
        $response = $this->postJson(route('gatekeeper.verify'), [
            'username' => 'wrong_user',
            'password' => 'wrong_password',
        ]);

        $response->assertStatus(401)
            ->assertJson(['success' => false]);

        $this->assertNull(session('gatekeeper_passed'));
    }

    public function test_gatekeeper_rate_limiting(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->postJson(route('gatekeeper.verify'), [
                'username' => 'wrong',
                'password' => 'wrong',
            ]);
        }

        $response = $this->postJson(route('gatekeeper.verify'), [
            'username' => 'wrong',
            'password' => 'wrong',
        ]);

        $response->assertStatus(429);
    }

    public function test_db_login_forbidden_without_gatekeeper(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
            'password' => Hash::make('password123'),
            'is_admin' => true,
        ]);

        $response = $this->postJson(route('login.post'), [
            'email' => 'admin@dinkes.go.id',
            'password' => 'password123',
        ]);

        $response->assertStatus(403);
    }

    public function test_db_login_successful_after_gatekeeper(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@dinkes.go.id',
            'password' => Hash::make('password123'),
            'is_admin' => true,
        ]);

        $this->withSession(['gatekeeper_passed' => true]);

        $response = $this->postJson(route('login.post'), [
            'email' => 'admin@dinkes.go.id',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_dashboard_protected_by_gatekeeper(): void
    {
        $user = User::factory()->create([
            'is_admin' => true,
        ]);

        // Accessing dashboard without gatekeeper session should redirect to login
        $response = $this->actingAs($user)->withHeader('X-Test-Gatekeeper', 'true')->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }
}
