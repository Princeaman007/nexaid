<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'amanprincea005@gmail.com'], // Condition de recherche
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Franceroot123'),
                'role' => 'superAdmin',
            ]
        );
    }
}