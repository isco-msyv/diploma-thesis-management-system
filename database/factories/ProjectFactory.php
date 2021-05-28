<?php

namespace Database\Factories;

use App\Helpers\ProjectStatus;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(50),
            'description' => $this->faker->realText(150),
            'teacher_id' => rand(2, 3),
            'status' => ProjectStatus::NOT_ASSIGNED
        ];
    }
}
