<?php

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
