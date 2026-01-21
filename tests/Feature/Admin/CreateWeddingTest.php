<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Wedding;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateWeddingTest extends TestCase
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
    public function super_admin_can_view_create_wedding_form()
    {
        // Arrange: Create super admin
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act: Visit create page
        $response = $this->actingAs($superAdmin)->get('/admin/weddings/create');

        // Assert: Form renders successfully
        $response->assertStatus(200);
        // Note: Inertia component assertion requires PestPHP's expect()
        // For PHPUnit, we just verify status code is 200
    }

    /** @test */
    public function super_admin_can_create_wedding_account_with_valid_data()
    {
        // Arrange: Create super admin
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act: Submit form with valid data
        $response = $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'siti.ahmad@example.com',
            'phone' => '0123456789',
            'password' => '', // Empty - will use phone as password
            'password_confirmation' => '',
        ]);

        // Assert: Wedding and User created, user has 'couple' role
        $this->assertDatabaseHas('weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'siti.ahmad@example.com',
            'name' => 'Siti & Ahmad',
        ]);

        $user = User::where('email', 'siti.ahmad@example.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue($user->hasRole('couple'));
        $this->assertNotNull($user->wedding_id);

        $response->assertStatus(302); // Redirect status
        $response->assertSessionHas('success');
    }

    /** @test */
    public function validation_fails_with_missing_required_fields()
    {
        // Arrange: Create super admin
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act: Submit form with missing fields
        $response = $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => '', // Missing
            'groom_name' => '', // Missing
            'email' => '', // Missing
            'phone' => '', // Missing
        ]);

        // Assert: Validation errors, no records created
        $response->assertSessionHasErrors(['bride_name', 'groom_name', 'email', 'phone']);

        $this->assertDatabaseCount('weddings', 0);
        $this->assertDatabaseCount('users', 1); // Only super admin
    }

    /** @test */
    public function duplicate_email_is_rejected()
    {
        // Arrange: Create existing user and super admin
        User::factory()->create(['email' => 'existing@example.com']);
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act: Try to create wedding with existing email
        $response = $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'existing@example.com', // Duplicate
            'phone' => '0123456789',
            'password' => '',
            'password_confirmation' => '',
        ]);

        // Assert: Validation error, no wedding created
        $response->assertSessionHasErrors(['email']);
        $this->assertDatabaseCount('weddings', 0);
    }

    /** @test */
    public function non_super_admin_cannot_access_create_wedding()
    {
        // Arrange: Create regular user (not super-admin)
        $user = User::factory()->create();

        // Act: Try to access create page
        $response = $this->actingAs($user)->get('/admin/weddings/create');

        // Assert: Forbidden (403)
        $response->assertStatus(403);
    }

    /** @test */
    public function guest_cannot_access_create_wedding()
    {
        // Act: Try to access create page without authentication
        $response = $this->get('/admin/weddings/create');

        // Assert: Redirect to login
        $response->assertRedirect('/login');
    }

    /** @test */
    public function password_is_hashed_using_bcrypt()
    {
        // Arrange: Create super admin
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        $phoneNumber = '0123456789';

        // Act: Create wedding with phone as password (default)
        $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'siti.ahmad@example.com',
            'phone' => $phoneNumber,
            'password' => '', // Empty - will use phone as password
            'password_confirmation' => '',
        ]);

        // Assert: Password is hashed
        $user = User::where('email', 'siti.ahmad@example.com')->first();
        $this->assertNotNull($user);
        $this->assertNotEquals($phoneNumber, $user->password);
        $this->assertTrue(\Hash::check($phoneNumber, $user->password));
    }

    /** @test */
    public function phone_number_used_as_default_password()
    {
        // Arrange: Create super admin
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        $phoneNumber = '0123456789';

        // Act: Create wedding WITHOUT password field (should default to phone)
        $response = $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'siti.ahmad@example.com',
            'phone' => $phoneNumber,
            'password' => '', // Empty - should use phone as password
            'password_confirmation' => '',
        ]);

        // Assert: User can log in with phone number as password
        $user = User::where('email', 'siti.ahmad@example.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue(\Hash::check($phoneNumber, $user->password));

        // Verify phone stored in database
        $this->assertEquals($phoneNumber, $user->phone);

        $response->assertStatus(302);
        $response->assertSessionHas('success');
        $response->assertSessionHas('couple_credentials');
    }

    /** @test */
    public function custom_password_overrides_phone_default()
    {
        // Arrange: Create super admin
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        $customPassword = 'myCustomPass123';

        // Act: Create wedding WITH custom password
        $response = $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'siti.ahmad@example.com',
            'phone' => '0123456789',
            'password' => $customPassword, // Custom password provided
            'password_confirmation' => $customPassword,
        ]);

        // Assert: User can log in with CUSTOM password (not phone)
        $user = User::where('email', 'siti.ahmad@example.com')->first();
        $this->assertNotNull($user);
        $this->assertTrue(\Hash::check($customPassword, $user->password));
        $this->assertFalse(\Hash::check('0123456789', $user->password));

        $response->assertStatus(302);
    }

    /** @test */
    public function couple_can_login_with_phone_as_password()
    {
        // Arrange: Create super admin and wedding account
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        $phoneNumber = '0198765432';

        $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Fatimah',
            'groom_name' => 'Ali',
            'email' => 'fatimah.ali@example.com',
            'phone' => $phoneNumber,
            'password' => '', // Use phone as password
            'password_confirmation' => '',
        ]);

        // Act: Couple attempts to log in with phone as password
        // Note: Couple login route doesn't exist yet, so we just verify credentials work
        $coupleUser = User::where('email', 'fatimah.ali@example.com')->first();

        // Assert: Phone number works as password for authentication
        $this->assertNotNull($coupleUser);
        $this->assertTrue(\Hash::check($phoneNumber, $coupleUser->password));
        $this->assertTrue($coupleUser->hasRole('couple'));
    }

    /** @test */
    public function phone_number_validation_accepts_valid_formats()
    {
        // Arrange: Create super admin
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act: Create wedding with various valid phone formats
        $testCases = [
            ['phone' => '0123456789', 'email' => 'test1@example.com'], // Standard Malaysian
            ['phone' => '+60123456789', 'email' => 'test2@example.com'], // With country code
            ['phone' => '01-2345 6789', 'email' => 'test3@example.com'], // With dashes and spaces
        ];

        foreach ($testCases as $i => $case) {
            $response = $this->actingAs($superAdmin)->post('/admin/weddings', [
                'bride_name' => "Test Bride {$i}",
                'groom_name' => "Test Groom {$i}",
                'email' => $case['email'],
                'phone' => $case['phone'],
                'password' => '',
                'password_confirmation' => '',
            ]);

            // Assert: No validation error for phone
            $response->assertSessionHasNoErrors('phone');
        }
    }

    /** @test */
    public function audit_logging_tracks_account_creation()
    {
        // Arrange: Create super admin
        $superAdmin = User::factory()->create();
        $superAdmin->assignRole('super-admin');

        // Act: Create wedding
        $this->actingAs($superAdmin)->post('/admin/weddings', [
            'bride_name' => 'Siti',
            'groom_name' => 'Ahmad',
            'email' => 'siti.ahmad@example.com',
            'phone' => '0123456789',
            'password' => '',
            'password_confirmation' => '',
        ]);

        // Assert: Log entry created (check log file)
        $logContents = file_get_contents(storage_path('logs/laravel.log'));
        $this->assertStringContainsString('Wedding account created', $logContents);
        $this->assertStringContainsString('siti.ahmad@example.com', $logContents);
        $this->assertStringContainsString('0123456789', $logContents);
    }
}
