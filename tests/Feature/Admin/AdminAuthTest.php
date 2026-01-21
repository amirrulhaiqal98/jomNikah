<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Run PermissionSeeder to create roles
        $this->seed(\Database\Seeders\PermissionSeeder::class);
    }

    /** @test */
    public function super_admin_can_login_with_valid_credentials()
    {
        // AC: 1 - Authenticate and redirect to dashboard
        $superAdmin = User::factory()->create([
            'email' => 'admin@jomnikah.com',
            'password' => bcrypt('password123'),
        ]);
        $superAdmin->assignRole('super-admin');

        $response = $this->post(route('admin.login.post'), [
            'email' => 'admin@jomnikah.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($superAdmin);
    }

    /** @test */
    public function login_fails_with_invalid_credentials()
    {
        // AC: 2 - Show bilingual error on failure
        User::factory()->create([
            'email' => 'admin@jomnikah.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('admin.login.post'), [
            'email' => 'admin@jomnikah.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHas('error');
        $response->assertSessionHas('error',
            'Maaf, kredensial log masuk tidak sah. / Sorry, these login credentials are invalid.'
        );
        $this->assertGuest();
    }

    /** @test */
    public function user_without_super_admin_role_cannot_login()
    {
        // User without super-admin role
        $user = User::factory()->create([
            'email' => 'user@jomnikah.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('admin.login.post'), [
            'email' => 'user@jomnikah.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHas('error');
        $this->assertGuest();
    }

    /** @test */
    public function authenticated_user_is_redirected_to_dashboard()
    {
        // AC: 3 - Auto-redirect if already logged in
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        $response = $this->actingAs($superAdmin)
            ->get(route('admin.login'));

        $response->assertRedirect(route('admin.dashboard'));
    }

    /** @test */
    public function guest_can_access_login_page()
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
    }

    /** @test */
    public function dashboard_requires_super_admin_role()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('admin.dashboard'));

        $response->assertStatus(403); // Forbidden
    }

    /** @test */
    public function super_admin_can_access_dashboard()
    {
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        $response = $this->actingAs($superAdmin)
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
    }

    /** @test */
    public function logout_works_correctly()
    {
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        $response = $this->actingAs($superAdmin)
            ->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $this->assertGuest();
    }

    /** @test */
    public function session_uses_http_only_cookies()
    {
        // AC: 4 - Verify session security (HTTP-only cookies)
        $response = $this->get(route('admin.login'));

        // Check session cookie configuration
        $config = config('session');
        $this->assertTrue($config['http_only'], 'Session cookies must be HTTP-only');
    }

    /** @test */
    public function login_requires_email_and_password()
    {
        $response = $this->post(route('admin.login.post'), [
            'email' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['email', 'password']);
    }

    /** @test */
    public function login_requires_valid_email_format()
    {
        $response = $this->post(route('admin.login.post'), [
            'email' => 'invalid-email',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
    }
}
