<?php

namespace Tests\Feature;

use App\Helpers\UserType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_has_admin_user()
    {
        $this->seed();

        $this->assertDatabaseHas('users', [
            'type' => UserType::ADMIN,
        ]);
    }

    public function test_database_has_teachers()
    {
        $this->seed();

        $this->assertDatabaseHas('users', [
            'type' => UserType::TEACHER,
        ]);
    }

    public function test_database_has_students()
    {
        $this->seed();

        $this->assertDatabaseHas('users', [
            'type' => UserType::STUDENT,
        ]);
    }

    public function test_database_has_projects()
    {
        $this->seed();

        $this->assertDatabaseCount('projects', 11);
    }
}
