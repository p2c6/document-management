<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => 'test1@gmail.com',
                'full_name' => 'John Doe',
                'role_id' => 1,
                'password' => bcrypt('password123'),
            ],
            [
                'email' => 'test2@gmail.com',
                'full_name' => 'Jin Doe',
                'role_id' => 2,
                'password' => bcrypt('password123'),
            ],
            [
                'email' => 'test3@gmail.com',
                'full_name' => 'Jack Doe',
                'role_id' => 3,
                'password' => bcrypt('password123'),
            ],
        ];
        
        foreach($users as $user) {
            User::create($user);
        }
    }
}
