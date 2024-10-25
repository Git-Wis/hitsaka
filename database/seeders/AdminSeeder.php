<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Créer un utilisateur admin par défaut
        User::create([
            'name' => 'Admin',
            'email' => 'admin@hitsaka.mg',
            'password' => Hash::make('H!lp1234'), 
            'is_admin' => true, 
         ]);
    }
}
