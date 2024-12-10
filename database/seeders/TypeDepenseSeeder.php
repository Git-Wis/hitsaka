<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeDepenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('depense_types')->insert([
            ['name' => 'Carburant', 'description' => 'Frais de carburant pour les navires'],
            ['name' => 'Entretien', 'description' => 'Coûts de maintenance et réparations'],
            ['name' => 'Salaires', 'description' => 'Paiement des équipages et employés'],
            ['name' => 'Publicité', 'description' => 'Dépenses liées au marketing et publicité'],
            ['name' => 'Assurance', 'description' => 'Primes pour assurer les navires, marchandises ou employés'],
            ['name' => 'Frais portuaires', 'description' => 'Droits d\'amarrage et frais portuaires'],
            ['name' => 'Intérêts sur prêts', 'description' => 'Paiement d\'intérêts pour les emprunts'],
            ['name' => 'Remboursements', 'description' => 'Frais de remboursement ou indemnisation des clients'],
        ]);
    }
}
