<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\LifeAreaController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::get('/health', function () {
        return response()->json([
            'success' => true,
            'data' => [
                'service' => 'dream-tracker-api',
                'status' => 'ok',
            ],
        ]);
    });

    Route::prefix('auth')->group(function (): void {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);

        Route::middleware('auth:sanctum')->group(function (): void {
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::get('/me', [AuthController::class, 'me']);
        });
    });

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::get('/profile', [ProfileController::class, 'show']);
        Route::patch('/profile', [ProfileController::class, 'update']);
        Route::get('/life-areas', [LifeAreaController::class, 'index']);
        Route::post('/life-areas', [LifeAreaController::class, 'store']);
        Route::patch('/life-areas/{lifeArea}', [LifeAreaController::class, 'update']);
        Route::delete('/life-areas/{lifeArea}', [LifeAreaController::class, 'destroy']);
    });
});
