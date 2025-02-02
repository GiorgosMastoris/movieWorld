<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'     => 'User 1',
                'email'    => 'user1@test.com',
                'password' => Hash::make('password'),
            ],
            [
                'name'     => 'User 2',
                'email'    => 'user2@test.com',
                'password' => Hash::make('password'),
            ]
        ];
        foreach ($users as $user) {
            User::factory()->create($user);
        }
        User::factory(20)->create();
    }
}
