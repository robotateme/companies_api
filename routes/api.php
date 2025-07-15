<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Company\SearchController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the API',
    ]);
});

Route::prefix('company')->group(function () {
    Route::post('search/area/rectangle', [SearchController::class, 'searchInRectangle']);
    Route::post('search/area/radius', [SearchController::class, 'searchInRadius']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::put('/user', [AuthController::class, 'updateUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
