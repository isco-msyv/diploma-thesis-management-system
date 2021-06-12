<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'is_verified' => rand(0, 1),
            'password' => '$2y$10$486ofanzrMXw4pR1HQ9fz.fSjQ/pqIOnxUzUNnBc.nipdULXsHqiS', // password
            'remember_token' => Str::random(10),
        ];
    }
}
