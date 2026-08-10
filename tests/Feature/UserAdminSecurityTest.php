<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserAdminSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_active_user_can_login(): void
    {
        $user = User::factory()->create([
            'email' => 'staff@dinkes.go.id',
            'password' => bcrypt('password123'),
            'is_active' => true,
            'is_admin' => false,
        ]);

        $response = $this->withSession(['gatekeeper_passed' => true])
            ->postJson('/dinkes-login', [
                'email' => 'staff@dinkes.go.id',
                'password' => 'password123',
            ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $this->assertAuthenticatedAs($user);
    }

    public function test_deactivated_user_cannot_login(): void
    {
        $user = User::factory()->create([
            'email' => 'staff_inactive@dinkes.go.id',
            'password' => bcrypt('password123'),
            'is_active' => false,
            'is_admin' => false,
        ]);

        $response = $this->withSession(['gatekeeper_passed' => true])
            ->postJson('/dinkes-login', [
                'email' => 'staff_inactive@dinkes.go.id',
                'password' => 'password123',
            ]);

        $response->assertStatus(403);
        $response->assertJson([
            'success' => false,
            'message' => 'Akun Anda dinonaktifkan. Silakan hubungi administrator.',
        ]);
        $this->assertGuest();
    }

    public function test_deactivated_logged_in_user_is_automatically_logged_out_on_next_request(): void
    {
        $user = User::factory()->create([
            'email' => 'staff@dinkes.go.id',
            'password' => bcrypt('password123'),
            'is_active' => true,
            'is_admin' => false,
        ]);

        $this->actingAs($user);

        // First access works (since they are active)
        $response1 = $this->get('/admin/dashboard');
        $response1->assertStatus(200);

        // Deactivate user in database
        $user->update(['is_active' => false]);

        // Second access fails and logs them out
        $response2 = $this->get('/admin/dashboard');

        $response2->assertRedirect('/dinkes-login');
        $this->assertGuest();
    }

    public function test_non_admin_cannot_access_user_management(): void
    {
        $user = User::factory()->create([
            'is_active' => true,
            'is_admin' => false,
        ]);

        $response = $this->actingAs($user)->get('/admin/users');
        $response->assertStatus(403);
    }

    public function test_admin_can_access_user_management(): void
    {
        $admin = User::factory()->create([
            'is_active' => true,
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)->get('/admin/users');
        $response->assertStatus(200);
    }
}
