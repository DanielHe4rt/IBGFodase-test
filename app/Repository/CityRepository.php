<?php

namespace App\Repository;

use App\Models\IBGE\City;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class CityRepository
{
    const PAGINATION_SIZE = 15;

    private Builder $query;

    public function __construct()
    {
        $this->query = City::query();
    }

    public function paginate(string $state): LengthAwarePaginator
    {
        return $this->query
            ->where('state', '=', $state)
            ->paginate(self::PAGINATION_SIZE);
    }
}
