<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Voyage;
use App\Models\Passage;
use App\Models\Reservation;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AdminSeeder::class);

        $this->call(TypeDepenseSeeder::class);

        // Créer 5 voyages et 10 passagers
        $voyages = Voyage::factory(5)->create();
        $passagers = Passage::factory(60)->create();

        // Créer des réservations en associant chaque passager et voyage de manière aléatoire
        Reservation::factory(120)->create([
            'idVoyage' => $voyages->random()->id,
            'idClient' => $passagers->random()->id,
        ]);
    }
}
