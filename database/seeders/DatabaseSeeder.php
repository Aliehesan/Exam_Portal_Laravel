<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'MMD',
            'email' => 'mmd@gmail.com',
            'password' => \Hash::make('12345678'),
            'role' => 'student',
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => \Hash::make('password'),
            'role' => 'student',
        ]);
    }
}
