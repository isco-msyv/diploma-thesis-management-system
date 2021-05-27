<?php

namespace Database\Seeders;

use App\Helpers\UserType;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
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
                    'full_name' => 'Lorem Ipsum',
                    'email' => 'lorem@admin.com',
                    'password' => bcrypt('secret'),
                    'type' => UserType::ADMIN,
                    'is_verified' => true,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            ]
        );
    }
}
