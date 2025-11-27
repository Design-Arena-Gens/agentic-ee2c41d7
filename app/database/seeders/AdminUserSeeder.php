<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'phone' => '+91-90000-00001',
                'role' => 'SUPER_ADMIN',
                'password' => bcrypt('SuperSecure#2024'),
            ],
            [
                'name' => 'Operations Admin',
                'email' => 'admin@example.com',
                'phone' => '+91-90000-00002',
                'role' => 'ADMIN',
                'password' => bcrypt('Admin@12345'),
            ],
            [
                'name' => 'Content Manager',
                'email' => 'content@example.com',
                'phone' => '+91-90000-00003',
                'role' => 'CONTENT_MANAGER',
                'password' => bcrypt('Content@12345'),
            ],
        ];

        foreach ($users as $user) {
            \App\Models\User::query()->updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
