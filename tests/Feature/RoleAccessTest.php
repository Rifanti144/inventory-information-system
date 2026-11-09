<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    private array $payload = [
        'vendor_name' => 'PT Test',
        'office_address' => 'Jl. Test No. 1',
        'company_legality' => 'PT',
        'pic_name' => 'Budi',
        'pic_contact' => '0812345678',
    ];

    private function makeUser(string $role, bool $active = true): User
    {
        // Factories ignore $fillable, so role / is_active can be set here.
        return User::factory()->create(['role' => $role, 'is_active' => $active]);
    }

    private function makeVendor(User $owner): Vendor
    {
        $vendor = new Vendor($this->payload);
        $vendor->user_id = $owner->id;
        $vendor->save();

        return $vendor;
    }

    // ---------- 1. who may log in ----------

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/vendors')->assertRedirect(route('login'));
    }

    public function test_inactive_user_cannot_login(): void
    {
        $user = $this->makeUser('staff', active: false);

        $this->post('/login', ['email' => $user->email, 'password' => 'password'])
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_user_deactivated_while_logged_in_is_kicked_out(): void
    {
        $user = $this->makeUser('staff', active: false);

        $this->actingAs($user)->get('/dashboard')->assertRedirect();

        $this->assertGuest();
    }

    // ---------- 2. who may use which feature (middleware) ----------

    public function test_viewer_can_see_vendor_list_but_not_open_create_form(): void
    {
        $viewer = $this->makeUser('viewer');

        $this->actingAs($viewer)->get('/vendors')->assertOk();
        $this->actingAs($viewer)->get('/vendors/create')->assertForbidden();
    }

    public function test_viewer_cannot_store_vendor(): void
    {
        $viewer = $this->makeUser('viewer');

        $this->actingAs($viewer)->post('/vendors', $this->payload)->assertForbidden();

        $this->assertDatabaseCount('vendors', 0);
    }

    public function test_only_admin_can_open_user_management(): void
    {
        $this->actingAs($this->makeUser('staff'))->get('/admin/users')->assertForbidden();
        $this->actingAs($this->makeUser('admin'))->get('/admin/users')->assertOk();
    }

    // ---------- 3. which action is allowed (policy) ----------

    public function test_staff_can_create_vendor_and_becomes_its_owner(): void
    {
        $staff = $this->makeUser('staff');

        $this->actingAs($staff)->post('/vendors', $this->payload)->assertRedirect(route('vendors.index'));

        $this->assertDatabaseHas('vendors', ['vendor_name' => 'PT Test', 'user_id' => $staff->id]);
    }

    public function test_staff_can_edit_own_vendor_but_not_someone_elses(): void
    {
        $staff = $this->makeUser('staff');
        $other = $this->makeUser('staff');

        $own = $this->makeVendor($staff);
        $foreign = $this->makeVendor($other);

        $changed = array_merge($this->payload, ['vendor_name' => 'PT Changed']);

        $this->actingAs($staff)->put("/vendors/{$own->id}", $changed)->assertRedirect(route('vendors.index'));
        $this->assertDatabaseHas('vendors', ['id' => $own->id, 'vendor_name' => 'PT Changed']);

        $this->actingAs($staff)->put("/vendors/{$foreign->id}", $changed)->assertForbidden();
        $this->assertDatabaseHas('vendors', ['id' => $foreign->id, 'vendor_name' => 'PT Test']);
    }

    public function test_staff_cannot_delete_even_own_vendor(): void
    {
        $staff = $this->makeUser('staff');
        $vendor = $this->makeVendor($staff);

        $this->actingAs($staff)->delete("/vendors/{$vendor->id}")->assertForbidden();

        $this->assertDatabaseHas('vendors', ['id' => $vendor->id]);
    }

    public function test_admin_can_edit_and_delete_any_vendor(): void
    {
        $admin = $this->makeUser('admin');
        $vendor = $this->makeVendor($this->makeUser('staff'));

        $changed = array_merge($this->payload, ['vendor_name' => 'PT By Admin']);

        $this->actingAs($admin)->put("/vendors/{$vendor->id}", $changed)->assertRedirect(route('vendors.index'));
        $this->assertDatabaseHas('vendors', ['id' => $vendor->id, 'vendor_name' => 'PT By Admin']);

        $this->actingAs($admin)->delete("/vendors/{$vendor->id}")->assertRedirect(route('vendors.index'));
        $this->assertDatabaseMissing('vendors', ['id' => $vendor->id]);
    }

    // ---------- registration cannot grant admin ----------

    public function test_new_registration_is_always_viewer(): void
    {
        $this->post('/register', [
            'name' => 'newbie',
            'email' => 'newbie@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
            'role' => 'admin', // must be ignored
        ])->assertRedirect();

        $this->assertDatabaseHas('users', ['email' => 'newbie@example.com', 'role' => 'viewer']);
    }
}
