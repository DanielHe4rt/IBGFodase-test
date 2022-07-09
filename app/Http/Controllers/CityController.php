<?php

namespace App\Http\Controllers;

use App\Repository\CityRepository;

class CityController extends Controller
{
    private CityRepository $repository;

    public function __construct(CityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getCitiesByState(string $state)
    {
        $stateExists = collect(config('states'))
            ->first(fn (array $data) => $data['slug'] == $state);

        if (!$stateExists) {
            abort(404, 'District/State not exists.');
        }

        return response()->json(
            $this->repository->paginate($state)
        );
    }
}
