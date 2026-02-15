<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'username' => 'admin',
                'password'=> bcrypt('admin'),
                'role' => UserRole::Admin->value,
                'status'=> UserStatus::Active->value,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=> 'Manager',
                'email'=> 'manager@mail.com',
                'username' => 'manager',
                'password'=> bcrypt('manager'),
                'role'=> UserRole::Manager->value,
                'status'=> UserStatus::Active->value,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'name'=> 'user',
                'email'=> 'user@gmail.com',
                'username'=> 'user',
                'password'=> bcrypt('user'),
                'role'=> UserRole::Employee->value,
                'status'=> UserStatus::Active->value,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]
        ];

        foreach ($users as $user) {
            if (!DB::table('users')->where('email', $user['email'])->exists()) {
                DB::table('users')->insert($user);
            }
        }
    }
}

