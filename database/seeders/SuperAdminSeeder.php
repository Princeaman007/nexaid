<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'amanprincea005@gmail.com',
            'password' => Hash::make('Franceroot123'),
            'role' => 'super_admin',
        ]);
    }
}