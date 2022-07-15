<?php

namespace App\Console\Commands;

use App\Models\IBGE\City;
use App\Services\IBGE\IbgeService;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class StateCitiesImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ibge:import-from-state {slug?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa todos os municipios de um determinado estado.';

    /**
     *  > Criar comunicação com a API do IBGE
     *  > Criar um comando artisan para importar as cidades do seu estado
     *  > Salvar as cidades no BD
     */
    public function handle(IbgeService $service): int
    {
        $this->info('Salve cachorro bora importar umas cidades');

        $rawState = $this->getState();
        $state = $this->transformState($rawState);

        $cities = $service->getCitiesByStateSlug($state);
        $this->persistCities($cities);

        return self::SUCCESS;
    }

    private function persistCities(array $cities)
    {
        collect($cities)
            ->chunk(500)
            ->each(function (Collection $citiesChunk) {
                $citiesChunk->each(fn ($city) => City::query()->create([
                    'state' => $city['microrregiao']['mesorregiao']['UF']['sigla'],
                    'name' => $city['nome']
                ]));
            });
    }

    private function getStates(): array
    {
        $states = config('states');

        return collect($states)
            ->map(fn($state) => $state['slug'] . ' - ' . $state['name'])
            ->toArray();
    }

    private function transformState(string $rawState): string
    {
        return substr($rawState, 0, 2);
    }

    /**
     * @return array|bool|string
     */
    public function getState(): string|array|bool
    {
        return $this->argument('slug') ?? $this->choice(
                'Insira a sigla do estado que você deseja importar os municipios.',
                $this->getStates()
            );
    }
}
