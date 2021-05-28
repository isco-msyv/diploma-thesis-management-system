<?php

namespace Database\Seeders;

use App\Helpers\ProjectStatus;
use App\Helpers\UserType;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::factory()->count(1)->has(Task::factory()->count(rand(5, 10)))->create(['student_id'=> 4, 'status' => ProjectStatus::IN_PROGRESS]);

        Project::factory()->count(5)->has(Task::factory()->count(rand(5, 10)))->create();

        $teachers = User::where('type', '=', UserType::TEACHER)->verified()->get()->pluck('id')->toArray();
        Project::factory()->count(5)->has(Task::factory()->count(rand(5, 10)))->create(['teacher_id' => $teachers[array_rand($teachers)]]);
    }
}
