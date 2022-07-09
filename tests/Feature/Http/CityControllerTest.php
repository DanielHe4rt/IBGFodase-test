<?php

namespace Tests\Feature\Http;

use App\Models\IBGE\City;
use Tests\TestCase;

class CityControllerTest extends TestCase
{
    public function test_guest_can_retrieve_cities_based_on_state()
    {
        // Prepare
        $city = City::factory()->create(['state' => 'DF']);

        // Act
        $response = $this->get(route('city.paginate', $city->state));

        // Assert
        $response->assertSee($city->name);
    }

    public function test_guest_should_receive_404_when_input_a_invalid_state()
    {
        // Act
        $response = $this->get(route('city.paginate', 'deixa-o-sub-na-twitch'));

        // Assert
        $response->assertNotFound();
    }

}
