<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'student@example.com'],
            [
                'name' => 'John Student',
                'password' => \Hash::make('password'),
                'role' => 'student',
            ]
        );

        \App\Models\User::updateOrCreate(
            ['email' => 'student2@example.com'],
            [
                'name' => 'Jane Smith',
                'password' => \Hash::make('password'),
                'role' => 'student',
            ]
        );

        \App\Models\User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => \Hash::make('password'),
                'role' => 'admin',
            ]
        );
    }
}
