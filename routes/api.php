<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/address/list', [AddressController::class, 'getAddresses'])->name('address.paginate');
Route::get('/address/{address}', [AddressController::class, 'getAddress'])->name('address.find');
Route::post('/address', [AddressController::class, 'postAddress'])->name('address.new');
Route::put('/address/{address}', [AddressController::class, 'putAddress'])->name('address.update');
Route::delete('/address/{address}', [AddressController::class, 'deleteAddress'])->name('address.delete');

Route::get('/states/{state}/cities', [CityController::class, 'getCitiesByState'])->name('city.paginate');
