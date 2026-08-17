<?php

namespace Tests\Feature;

use App\Models\Setting;
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

    public function test_admin_can_update_gatekeeper_credentials(): void
    {
        $admin = User::factory()->create([
            'is_active' => true,
            'is_admin' => true,
        ]);

        $response = $this->actingAs($admin)
            ->post('/admin/users/update-gatekeeper', [
                'gatekeeper_username' => 'new_gate_username',
                'gatekeeper_password' => 'new_gate_password',
            ]);

        $response->assertRedirect();

        $this->assertEquals('new_gate_username', Setting::get('gatekeeper_username'));
        $this->assertEquals('new_gate_password', Setting::get('gatekeeper_password'));

        // Verify that authentication fails with old/default values now
        $verifyResponseOld = $this->postJson('/dinkes-gatekeeper', [
            'username' => 'admin',
            'password' => 'dinkes2026',
        ]);
        $verifyResponseOld->assertStatus(401);

        // Verify that authentication succeeds with the newly updated credentials
        $verifyResponseNew = $this->postJson('/dinkes-gatekeeper', [
            'username' => 'new_gate_username',
            'password' => 'new_gate_password',
        ]);
        $verifyResponseNew->assertStatus(200);
        $verifyResponseNew->assertJson(['success' => true]);
    }

    public function test_admin_can_delete_inactive_admin_when_active_admin_exists(): void
    {
        $currentAdmin = User::factory()->create([
            'is_active' => true,
            'is_admin' => true,
        ]);

        $inactiveAdmin = User::factory()->create([
            'name' => 'Inactive Admin',
            'is_active' => false,
            'is_admin' => true,
        ]);

        $response = $this->actingAs($currentAdmin)
            ->delete("/admin/users/{$inactiveAdmin->id}");

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseMissing('users', ['id' => $inactiveAdmin->id]);
    }

    public function test_admin_cannot_delete_last_active_admin(): void
    {
        $lastActiveAdmin = User::factory()->create([
            'is_active' => true,
            'is_admin' => true,
        ]);

        $otherAdmin = User::factory()->create([
            'is_active' => true,
            'is_admin' => true,
        ]);

        // Attempting to delete $lastActiveAdmin while another active admin exists should succeed
        $response = $this->actingAs($otherAdmin)
            ->delete("/admin/users/{$lastActiveAdmin->id}");

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseMissing('users', ['id' => $lastActiveAdmin->id]);

        // Now $otherAdmin is the last active admin. Attempting to delete $otherAdmin by himself or if sole active admin is blocked
        $response2 = $this->actingAs($otherAdmin)
            ->delete("/admin/users/{$otherAdmin->id}");

        $response2->assertSessionHas('error');
        $this->assertDatabaseHas('users', ['id' => $otherAdmin->id]);
    }
}
