<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Passage;
use App\Models\Voyage;
use App\Models\Reservation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Reservation::class;

    public function definition()
    {
        return [
            'idClient'=>Passage::all()->random()->id,  // Crée un Passager associé
            'idVoyage' => Voyage::all()->random()->id,    // Crée un Voyage associé
            'direction' => $this->faker->randomElement(['TMV-SM', 'SM-TMV']),
            'date' => $this->faker->dateTimeBetween('now', '+3 months'),
            'payer' => $this->faker->boolean(),
        ];
    }
}
