<?php

namespace Tests\Feature;

use App\Helpers\UserType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_not_login_with_incorrect_password()
    {
        $user = User::factory()->state([
            'type' => UserType::STUDENT,
            'is_verified' => 1
        ])->create();

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_user_can_not_view_a_login_form_when_authenticated()
    {
        $user = User::factory()->state([
            'type' => UserType::STUDENT,
            'is_verified' => 1,
        ])->create();

        $response = $this->actingAs($user)->get('/login');

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }

    public function test_user_can_not_login_when_not_verified()
    {
        $user = User::factory()->state([
            'type' => UserType::STUDENT,
            'is_verified' => 0
        ])->create();

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function test_user_can_login_when_verified()
    {
        $user = User::factory()->state([
            'type' => UserType::STUDENT,
            'is_verified' => 1
        ])->create();

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }
}
