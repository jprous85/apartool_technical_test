<?php

use App\Http\Controllers\ApartmentController;
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

Route::middleware('auth:api')->group(function () {
    Route::get('/apartments', [ApartmentController::class, 'index'])->name('apartments');
    Route::get('/apartment/{id}', [ApartmentController::class, 'view'])->name('apartment-show');
    Route::post('/apartment/create', [ApartmentController::class, 'store'])->name('apartment-create');
    Route::post('/apartment/update/{id}', [ApartmentController::class, 'update'])->name('apartment-update');
    Route::get('/apartment/trash/{id}', [ApartmentController::class, 'trash'])->name('apartment-trash');
    Route::get('/apartment/delete/{id}', [ApartmentController::class, 'delete'])->name('apartment-delete');
});
