<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'bcs-boost@mit.edu'],
            [
                'name' => 'admin',
                'email_verified_at' => now(),
                'verified_status' => 1,
                'password' => Hash::make('abcd1234!'),
                'role' => 1,
            ]
        );

        User::factory(5)->create();
    }
}
