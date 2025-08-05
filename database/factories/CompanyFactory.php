<?php

namespace Database\Factories;

use App\Models\Company;
use Faker\Provider\ru_RU\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new PhoneNumber($this->faker));
        return [
            'phones' => $this->faker->unique()->e164PhoneNumber(),
        ];
    }
}
