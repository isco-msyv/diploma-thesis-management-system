<?php

namespace Tests\Feature;

use App\Helpers\UserType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTypeAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_not_access_list_users_route_when_user_type_not_admin()
    {
        $user = User::factory()->state([
            'type' => UserType::TEACHER,
            'is_verified' => 1,
        ])->create();

        $response = $this->actingAs($user)->get('admin/users');
        $response->assertRedirect('/');
        $response->assertStatus(302);
    }

    public function test_user_can_not_access_edit_user_route_when_user_type_not_admin()
    {
        $this->seed();

        $user = User::factory()->state([
            'type' => UserType::TEACHER,
            'is_verified' => 1,
        ])->create();

        $response = $this->actingAs($user)->get('admin/users/1');
        $response->assertRedirect('/');
        $response->assertStatus(302);
    }

    public function test_user_can_not_access_delete_user_route_when_user_type_not_admin()
    {
        $this->seed();

        $user = User::factory()->state([
            'type' => UserType::TEACHER,
            'is_verified' => 1,
        ])->create();

        $response = $this->actingAs($user)->delete('admin/users/1');
        $response->assertRedirect('/');
        $response->assertStatus(302);
    }
}
