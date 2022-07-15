<?php

namespace Tests\Feature\Console;

use App\Models\IBGE\City;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StateCitiesImportCommandTest extends TestCase
{
    use DatabaseMigrations;

    public function test_base_import()
    {
        // Agir
        $this->artisan('ibge:import-from-state', ['slug' => 'DF']);

        // Fazer asserções
        $this->assertDatabaseHas('cities', [
            'state' => 'DF',
            'name' => 'Brasília'
        ]);
    }
}
