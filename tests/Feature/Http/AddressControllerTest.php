<?php

namespace Tests\Feature\Http;

use App\Models\IBGE\Address;
use App\Models\IBGE\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_retrieve_paginated_addresses_list(): void
    {
        // Prepare
        $address = Address::factory()->create();

        // Act
        $result = $this->get(route('address.paginate'));

        // Assert
        $result->assertOk();
        $result->assertJsonFragment(['street' => $address->street]);
    }

    public function test_guest_can_create_a_new_address(): void
    {
        // Prepare
        $city = City::factory()->create();
        $payload = [
            'city_id' => $city->id,
            'street' => 'Rua das flores',
            'neighborhood' => 'Centro',
            'number' => 1337
        ];

        // Act
        $result = $this->post(route('address.new'), $payload);

        // Assert
        $result->assertCreated();
        $this->assertDatabaseHas('city_addresses', $payload);
    }

    public function test_guest_can_retrieve_a_single_address(): void
    {
        // Prepare
        $address = Address::factory()->create();

        // Act
        $response = $this->get(route('address.find', ['address' => $address]));

        // Assert
        $response->assertOk();
        $response->assertJson($address->toArray());
    }

    public function test_guest_can_update_an_address(): void
    {
        // Prepare
        $address = Address::factory()->create();
        $payload = [
            'street' => 'Rua das flores',
            'neighborhood' => 'Centro',
            'number' => 1337
        ];
        // Act
        $response = $this->put(route('address.update', $address->id), $payload);

        // Assert
        $response->assertOk();
        $response->assertSee($address->refresh()->toArray());
        $this->assertDatabaseHas('city_addresses', $payload);
    }

    public function test_guest_can_delete_an_address(): void
    {
        // Prepare
        $address = Address::factory()->create();

        // Act
        $response = $this->delete(route('address.delete', $address->id));

        // Assert
        $response->assertNoContent();
        $this->assertDatabaseMissing('city_addresses', $address->toArray());
    }
}
