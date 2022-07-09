<?php

namespace Database\Factories\IBGE;

use App\Models\IBGE\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'city_id' => City::factory(),
            'street' => $this->faker->streetAddress(),
            'neighborhood' => $this->faker->word(),
            'number' => $this->faker->randomNumber(3)
        ];
    }
}
