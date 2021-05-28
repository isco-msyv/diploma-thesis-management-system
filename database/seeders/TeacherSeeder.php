<?php

namespace Database\Seeders;

use App\Helpers\UserType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
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
                    'full_name' => 'John Doe',
                    'email' => 'john@teacher.com',
                    'password' => bcrypt('secret'),
                    'type' => UserType::TEACHER,
                    'is_verified' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'full_name' => 'Jane Doe',
                    'email' => 'jane@teacher.com',
                    'password' => bcrypt('secret'),
                    'type' => UserType::TEACHER,
                    'is_verified' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            ]
        );

//        User::factory()->count(5)->create(['type' => UserType::TEACHER]);
    }
}
