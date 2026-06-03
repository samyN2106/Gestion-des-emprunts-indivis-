<?php

namespace Database\Factories;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1, 50),
            'modality_id' => fake()->numberBetween(1,5),
            'amount' => fake()->numberBetween(5000, 500000),
            'interest_rate' => fake()->numberBetween(1,10),
            'duration'=>fake()->numberBetween(1,12),
            'period_duration' => fake()->randomElement(['ans', 'mois']),
            'period_repay' => fake()->randomElement(['Annuites', 'Mensualites', 'Semestrialite', 'Trimestrialite']),
        ];
    }
}
