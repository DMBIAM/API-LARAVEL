<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FavoritesController;

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

$version = '/v1';

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
|                                   AREA
|--------------------------------------------------------------------------
*/

// POST
Route::post($version. '/areas', [AreaController::class, 'store']);

// GET
Route::get($version. '/areas', [AreaController::class, 'index']);

/*
|--------------------------------------------------------------------------
|                                   CATEGORY
|--------------------------------------------------------------------------
*/

// POST
Route::post($version. '/categories', [CategoryController::class, 'store']);

// GET
Route::get($version. '/categories', [CategoryController::class, 'index']);


/*
|--------------------------------------------------------------------------
|                                   CITY
|--------------------------------------------------------------------------
*/

// POST
Route::post($version. '/cities', [CityController::class, 'store']);

// GET
Route::get($version. '/cities', [CityController::class, 'index']);

/*
|--------------------------------------------------------------------------
|                                   COMPANY
|--------------------------------------------------------------------------
*/

// POST
Route::post($version. '/companies', [CompanyController::class, 'store']);

// GET
Route::get($version. '/companies', [CompanyController::class, 'index']);

/*
|--------------------------------------------------------------------------
|                                   EMPLOYEED
|--------------------------------------------------------------------------
*/

// POST
Route::post($version. '/employees', [EmployeeController::class, 'store']);

// GET
Route::get($version. '/employees', [EmployeeController::class, 'index']);

/*
|--------------------------------------------------------------------------
|                                   FAVORITE
|--------------------------------------------------------------------------
*/

// POST
Route::post($version. '/favorites', [FavoritesController::class, 'store']);

// GET
Route::get($version. '/favorites', [FavoritesController::class, 'index']);

// DELETE
Route::delete($version . '/favorites/{id}', [FavoritesController::class, 'destroy']);