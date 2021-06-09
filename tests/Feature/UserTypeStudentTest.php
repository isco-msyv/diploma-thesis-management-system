<?php

namespace Tests\Feature;

use App\Helpers\UserType;
use App\Models\Project;
use App\Models\ProjectRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTypeStudentTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_not_access_topics_when_has_project()
    {
        $this->seed();

        $project = Project::with(['student'])->firstOrFail();

        $response = $this->actingAs($project->student)->get(route('student.topics.index'));
        $response->assertRedirect(route('student.project.show'));
        $response->assertStatus(302);
    }

    public function test_student_can_not_access_topics_when_has_project_request()
    {
        $this->seed();

        $topic = Project::with(['teacher'])
            ->doesntHave('request')
            ->doesntHave('student')
            ->firstOrFail();

        $student = User::doesntHave('studentProject')->doesntHave('studentProjectRequest')->where('type', '=', UserType::STUDENT)->firstOrFail();

        ProjectRequest::create([
            'project_id' => $topic->id,
            'student_id' => $student->id
        ]);

        $response = $this->actingAs($student)->get(route('student.topics.index'));
        $response->assertRedirect(route('student.project.show'));
        $response->assertStatus(302);
    }
}
