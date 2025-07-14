<?php

use App\Http\Controllers\Company\AreaSearchController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the API',
    ]);
});
Route::prefix('company')->group(function () {
    Route::post('search/area/rectangle', [AreaSearchController::class, 'searchInRectangle']);
    Route::post('search/area/radius', [AreaSearchController::class, 'searchInRadius']);
});
