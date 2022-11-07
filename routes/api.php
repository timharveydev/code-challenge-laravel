<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;

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

// Get all Customers
Route::get('customers', [CustomerController::class, 'index']);

// Get individual Customer
Route::get('customers/{id}', [CustomerController::class, 'show']);

// Create new Customer
Route::post('customers', [CustomerController::class, 'store']);

// Update existing Customer
Route::put('customers/{id}', [CustomerController::class, 'update']);