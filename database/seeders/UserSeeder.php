<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use RuntimeException;

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
                'name' => 'wise admin',
                'password' =>Hash::make($this->password('SEED_ADMIN_PASSWORD')),
                'role' => 'admin'
            ]
        );
           User::updateOrCreate(
            ['email' => 'vivian@randomplay.id'],
            [
                'name' => 'vivian staff',
                'password' => Hash::make($this->password('SEED_ADMIN_PASSWORD')),
                'role' => 'staff'
            ]
           );
    }
     private function password(string $key): string
    {
        $value = env($key);

        if (! empty($value)) {
            return $value;
        }

        if (app()->environment(['local', 'testing'])) {
            return 'password';
        }

        throw new RuntimeException("Variabel $key wajib diisi untuk seeding di luar lingkungan local.");
    }
}

