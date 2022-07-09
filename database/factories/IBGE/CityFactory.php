<?php

namespace Database\Factories\IBGE;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IBGE\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'state' => $this->faker->countryISOAlpha3(),
            'name' => $this->faker->city()
        ];
    }
}
