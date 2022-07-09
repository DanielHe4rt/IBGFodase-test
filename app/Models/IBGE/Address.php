<?php

namespace App\Models\IBGE;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'city_addresses';

    protected $fillable = [
        'city_id',
        'street',
        'neighborhood',
        'number'
    ];
}
