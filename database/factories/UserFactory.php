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
            'password' => '$2y$10$zZjYSj6VWJVqKGxQ1m6z8eLuUJd/sCFj6Wdluqw4VJWrEoYhh8tDW', // secret
            'remember_token' => Str::random(10),
        ];
    }
}
