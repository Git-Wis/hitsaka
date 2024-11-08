<?php

namespace Database\Factories;

use App\Models\Voyage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voyage>
 */
class VoyageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Voyage::class;

    public function definition()
    {
        return [
            'Nom' => $this->faker->randomElement(['TMV-SM', 'SM-TMV']),
            'date' => $this->faker->dateTimeBetween('now', '+3 months'),
        ];
    }
}
