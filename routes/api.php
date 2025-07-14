<?php

use App\Http\Controllers\Company\AreaSearchController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/company')->group(function () {
    Route::post('/search/area/rectangle', [AreaSearchController::class, 'searchInRectangle']);
    Route::post('/search/area/radius', [AreaSearchController::class, 'searchInArea']);
});
