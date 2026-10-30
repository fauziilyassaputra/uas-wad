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
        User::updateOrCreate(
            ['email' => 'wise@randomplay.id'],
            [
                'name' => 'wise',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );
           User::updateOrCreate(
            ['email' => 'vivian@randomplay.id'],
            [
                'name' => 'vivian',
                'password' => Hash::make('password'),
                'role' => 'staff'
            ]
           );
    }
}
