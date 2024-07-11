<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ProfileController routes
Route::controller(ProfileController::class)->group(function () {
    Route::get('/profiles', 'list');
    Route::post('/profile/create', 'create')->middleware(['auth:sanctum', 'can:create']);
    Route::match(['PUT', 'POST'], '/profile/{profile}', 'update')->middleware(['auth:sanctum', 'can:update']);
    Route::delete('/profile/{profile}', 'delete')->middleware(['auth:sanctum', 'can:delete']);
});
