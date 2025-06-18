<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NewSuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Supprimer l'ancien super admin s'il existe
        User::where('email', 'admin@nexaid.com')->delete();
        
        // Créer le nouveau super admin
        User::create([
            'name' => 'Super Administrator',
            'email' => 'princeaman635@gmail.com',
            'password' => Hash::make('SuperAdmin123!'),
            'role' => 'superAdmin',
            'email_verified_at' => now(), // Email vérifié automatiquement
        ]);

        echo "✅ Super Admin créé avec succès !\n";
        echo "📧 Email: admin@nexaid.com\n";
        echo "🔑 Mot de passe: SuperAdmin123!\n";
        echo "👤 Rôle: super_admin\n";
    }
}