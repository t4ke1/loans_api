<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\loan;
use Illuminate\Database\Eloquent\Factories\Factory;

class LoanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = loan::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'borrower_name' => $this->faker->name,
            'borrow_volume' => $this->faker->numberBetween(100, 1000),
            'borrow_date' => $this->faker->date(),
            'monthly_payment' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
