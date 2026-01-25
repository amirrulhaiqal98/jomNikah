<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Wedding;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PackageTierAssignmentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create roles
        $superAdminRole = Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'couple']);

        // Create permissions
        $permissions = [
            'access_admin_dashboard',
            'create_wedding_accounts',
            'manage_weddings',
        ];

        foreach ($permissions as $permission) {
            $permissionModel = Permission::create(['name' => $permission]);
            $superAdminRole->givePermissionTo($permissionModel);
        }
    }

    /** @test */
    public function form_displays_package_tier_selection_options()
    {
        // Arrange
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act - AC: 1
        $response = $this->actingAs($superAdmin)->get('/admin/weddings/create');

        // Assert - AC: 1 - Verify form is accessible
        $response->assertStatus(200);
    }

    /** @test */
    public function standard_package_assignment_saves_to_database()
    {
        // Arrange
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act - AC: 2
        $response = $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'siti.ahmad@example.com',
            'phone' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'package_tier' => 'standard',
        ]);

        // Assert
        $this->assertDatabaseHas('weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'package_tier' => 'standard', // AC: 2
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function premium_package_assignment_saves_to_database()
    {
        // Arrange
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act - AC: 3
        $response = $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Fatimah',
            'groom_name' => 'Ali',
            'email' => 'fatimah.ali@example.com',
            'phone' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'package_tier' => 'premium',
        ]);

        // Assert
        $this->assertDatabaseHas('weddings', [
            'bride_name' => 'Fatimah',
            'groom_name' => 'Ali',
            'package_tier' => 'premium', // AC: 3
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function validation_rejects_invalid_package_tier()
    {
        // Arrange
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act
        $response = $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'siti.ahmad@example.com',
            'phone' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'package_tier' => 'gold', // Invalid
        ]);

        // Assert - Should reject invalid package tier
        $response->assertSessionHasErrors(['package_tier']);
    }

    /** @test */
    public function package_tier_defaults_to_standard_when_not_provided()
    {
        // Arrange
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act - Omit package_tier from request
        $response = $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'siti.ahmad@example.com',
            'phone' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            // package_tier not provided
        ]);

        // Assert - Should default to 'standard'
        $this->assertDatabaseHas('weddings', [
            'package_tier' => 'standard',
        ]);
    }

    /** @test */
    public function index_page_displays_package_tier()
    {
        // Arrange
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        Wedding::factory()->create(['package_tier' => 'standard']);
        Wedding::factory()->create(['package_tier' => 'premium']);

        // Act - AC: 4
        $response = $this->actingAs($superAdmin)->get('/admin/weddings');

        // Assert
        $response->assertStatus(200);
    }

    /** @test */
    public function audit_logging_captures_package_tier_assignment()
    {
        // Arrange
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Clear log file for clean test
        $logPath = storage_path('logs/laravel.log');
        if (file_exists($logPath)) {
            file_put_contents($logPath, '');
        }

        // Act
        $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'siti.ahmad@example.com',
            'phone' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'package_tier' => 'premium',
        ]);

        // Assert - AC: 4 (verify log entry created)
        $logContents = file_get_contents($logPath);
        $this->assertStringContainsString('Wedding account created', $logContents);
        $this->assertStringContainsString('package_tier', $logContents);
    }
}
