<?php

use App\Http\Controllers\Cars\Api\CarsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('cars', CarsController::class);
Route::group(['prefix' => 'cars'], function () {
    Route::get('/export', [CarsController::class, 'export'])->name('cars.export');
    Route::get('/autocomplete/{make}', [CarsController::class, 'autocomplete']);

});

