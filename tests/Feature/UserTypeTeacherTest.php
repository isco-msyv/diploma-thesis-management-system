<?php

namespace Tests\Feature;

use App\Helpers\UserType;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTypeTeacherTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_not_access_create_topic_route_when_user_type_not_teacher()
    {
        $user = User::factory()->state([
            'type' => UserType::STUDENT,
            'is_verified' => 1,
        ])->create();

        $response = $this->actingAs($user)->get(route('teacher.topics.create'));
        $response->assertRedirect('/');
        $response->assertStatus(302);
    }

    public function test_user_can_not_access_complete_project_when_user_type_not_teacher()
    {
        $this->seed();

        $user = User::where('type', '=', UserType::STUDENT)->firstOrFail();

        $project = Project::has('student')->firstOrFail();

        $response = $this->actingAs($user)->put(route('teacher.projects.complete', $project));
        $response->assertRedirect('/');
        $response->assertStatus(302);
    }
}
