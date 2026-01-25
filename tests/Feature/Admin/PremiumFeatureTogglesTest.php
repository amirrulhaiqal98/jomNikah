<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Wedding;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PremiumFeatureTogglesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create roles
        $superAdminRole = Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'couple']);

        // Create premium feature permissions (Story 1.4)
        Permission::firstOrCreate(['name' => 'access_wish_present_registry']);
        Permission::firstOrCreate(['name' => 'access_digital_ang_pow']);

        // Create admin permissions
        $permissions = [
            'access_admin_dashboard',
            'create_wedding_accounts',
            'manage_weddings',
        ];

        foreach ($permissions as $permission) {
            $permissionModel = Permission::firstOrCreate(['name' => $permission]);
            $superAdminRole->givePermissionTo($permissionModel);
        }
    }

    /** @test */
    public function form_displays_feature_toggle_checkboxes()
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
    public function checking_wish_present_for_standard_couple_grants_permission()
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
            'wish_present_enabled' => true, // Enable for Standard couple
            'digital_ang_pow_enabled' => false,
        ]);

        // Assert
        $this->assertDatabaseHas('weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'package_tier' => 'standard',
            'wish_present_enabled' => true, // AC: 2
            'digital_ang_pow_enabled' => false,
        ]);

        $user = User::where('email', 'siti.ahmad@example.com')->first();
        $this->assertTrue($user->hasPermissionTo('access_wish_present_registry')); // AC: 2
        $this->assertFalse($user->hasPermissionTo('access_digital_ang_pow')); // AC: 2

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    /** @test */
    public function checking_digital_ang_pow_for_standard_couple_grants_permission()
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
            'package_tier' => 'standard',
            'wish_present_enabled' => false,
            'digital_ang_pow_enabled' => true, // Enable independently
        ]);

        // Assert - AC: 3
        $this->assertDatabaseHas('weddings', [
            'bride_name' => 'Fatimah',
            'groom_name' => 'Ali',
            'wish_present_enabled' => false,
            'digital_ang_pow_enabled' => true, // AC: 3
        ]);

        $user = User::where('email', 'fatimah.ali@example.com')->first();
        $this->assertFalse($user->hasPermissionTo('access_wish_present_registry'));
        $this->assertTrue($user->hasPermissionTo('access_digital_ang_pow')); // AC: 3

        $response->assertRedirect();
    }

    /** @test */
    public function unchecking_wish_present_for_premium_couple_revokes_permission()
    {
        // Arrange
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Create wedding first
        $wedding = Wedding::factory()->create([
            'package_tier' => 'premium',
            'wish_present_enabled' => true,
            'digital_ang_pow_enabled' => true,
        ]);

        // Create user and link to wedding
        $user = User::factory()->create([
            'wedding_id' => $wedding->id,
        ]);
        $user->assignRole('couple');
        $user->givePermissionTo(['access_wish_present_registry', 'access_digital_ang_pow']);

        // Act - AC: 4 (uncheck Wish Present via edit)
        $response = $this->actingAs($superAdmin)->put("/admin/weddings/{$wedding->id}", [
            'bride_name' => $wedding->bride_name,
            'groom_name' => $wedding->groom_name,
            'wish_present_enabled' => false, // Uncheck
            'digital_ang_pow_enabled' => true, // Keep enabled
        ]);

        // Check if update was successful
        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        // Assert - AC: 4
        $this->assertDatabaseHas('weddings', [
            'id' => $wedding->id,
            'wish_present_enabled' => false, // AC: 4
            'digital_ang_pow_enabled' => true, // AC: 4 - Still enabled
        ]);

        $wedding->refresh();
        $this->assertFalse($wedding->user->hasPermissionTo('access_wish_present_registry')); // AC: 4
        $this->assertTrue($wedding->user->hasPermissionTo('access_digital_ang_pow')); // AC: 4
    }

    /** @test */
    public function both_features_disabled_shows_no_permissions()
    {
        // Arrange
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act - AC: 5
        $response = $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Aisha',
            'groom_name' => 'Rahman',
            'email' => 'aisha.rahman@example.com',
            'phone' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'package_tier' => 'standard',
            'wish_present_enabled' => false, // AC: 5
            'digital_ang_pow_enabled' => false, // AC: 5
        ]);

        // Assert - AC: 5
        $user = User::where('email', 'aisha.rahman@example.com')->first();
        $this->assertFalse($user->hasPermissionTo('access_wish_present_registry')); // AC: 5
        $this->assertFalse($user->hasPermissionTo('access_digital_ang_pow')); // AC: 5

        $this->assertDatabaseHas('weddings', [
            'wish_present_enabled' => false,
            'digital_ang_pow_enabled' => false,
        ]);
    }

    /** @test */
    public function audit_logging_captures_feature_toggle_assignments()
    {
        // Arrange
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Clear log file for clean test
        $logPath = storage_path('logs/laravel.log');
        if (file_exists($logPath)) {
            file_put_contents($logPath, '');
        }

        // Act - AC: 1 (verify log entry created)
        $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'siti.ahmad@example.com',
            'phone' => '0123456789',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'package_tier' => 'premium',
            'wish_present_enabled' => true,
            'digital_ang_pow_enabled' => true,
        ]);

        // Assert - AC: 1 (verify log entry created)
        $logContents = file_get_contents($logPath);
        $this->assertStringContainsString('Wedding account created', $logContents);
        $this->assertStringContainsString('wish_present_enabled', $logContents);
        $this->assertStringContainsString('digital_ang_pow_enabled', $logContents);
    }
}
