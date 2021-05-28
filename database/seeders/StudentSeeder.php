<?php

namespace Database\Seeders;

use App\Helpers\UserType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'full_name' => 'Bob Smith',
                    'email' => 'bob@student.com',
                    'password' => bcrypt('secret'),
                    'type' => UserType::STUDENT,
                    'is_verified' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'full_name' => 'Janie Smith',
                    'email' => 'janie@student.com',
                    'password' => bcrypt('secret'),
                    'type' => UserType::STUDENT,
                    'is_verified' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            ]
        );

//        User::factory()->count(5)->create(['type' => UserType::STUDENT]);
    }
}
