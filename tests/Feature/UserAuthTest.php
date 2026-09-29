<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserAuthTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(string $email = 'budi@test.com', string $plain = 'rahasia123'): User
    {
        DB::table('users')->insert([
            'name' => 'Budi',
            'email' => $email,
            'password' => Hash::make($plain),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return (new User)->setRawAttributes(
            (array) DB::table('users')->where('email', $email)->first()
        );
    }

    public function test_admin_area_requires_login(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
        $this->get(route('users.index'))->assertRedirect(route('login'));
        $this->get(route('products.index'))->assertRedirect(route('login'));
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $this->makeUser();

        $this->post(route('login.submit'), [
            'email' => 'budi@test.com',
            'password' => 'password-salah',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_login_fails_when_email_does_not_exist(): void
    {
        $this->post(route('login.submit'), [
            'email' => 'tidak-ada@test.com',
            'password' => 'rahasia123',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_login_succeeds_with_correct_password(): void
    {
        $this->makeUser();

        $this->post(route('login.submit'), [
            'email' => 'budi@test.com',
            'password' => 'rahasia123',
        ])->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticated();
    }

    public function test_logout_clears_session(): void
    {
        $this->actingAs($this->makeUser());

        $this->post(route('logout'))->assertRedirect(route('login'));

        $this->assertGuest();
    }

    public function test_stored_password_is_hashed_not_plaintext(): void
    {
        $this->actingAs($this->makeUser('admin@test.com'));

        $this->post(route('users.store'), [
            'name' => 'Sari',
            'email' => 'sari@test.com',
            'password' => 'rahasia123',
            'password_confirmation' => 'rahasia123',
        ])->assertRedirect(route('users.index'));

        $stored = DB::table('users')->where('email', 'sari@test.com')->first();

        $this->assertNotSame('rahasia123', $stored->password);
        $this->assertTrue(Hash::check('rahasia123', $stored->password));
    }

    public function test_update_keeps_old_password_when_field_left_blank(): void
    {
        $user = $this->makeUser('sari2@test.com');
        $this->actingAs($user);

        $this->put(route('users.update', $user->id), [
            'name' => 'Sari Baru',
            'email' => 'sari2@test.com',   // email sendiri, harus lolos Rule::unique()->ignore()
        ])->assertRedirect(route('users.index'));

        $stored = DB::table('users')->where('id', $user->id)->first();

        $this->assertSame('Sari Baru', $stored->name);
        $this->assertTrue(Hash::check('rahasia123', $stored->password));
    }

    public function test_cannot_delete_own_account(): void
    {
        $user = $this->makeUser('sari3@test.com');
        $this->actingAs($user);

        $this->delete(route('users.destroy', $user->id))->assertForbidden();

        $this->assertSame(1, DB::table('users')->count());
    }

    public function test_user_list_never_exposes_password_hash(): void
    {
        $this->actingAs($this->makeUser('sari4@test.com'));

        $content = $this->get(route('users.index'))->assertOk()->getContent();

        $hash = DB::table('users')->where('email', 'sari4@test.com')->value('password');

        $this->assertStringNotContainsString($hash, $content);
    }
}
