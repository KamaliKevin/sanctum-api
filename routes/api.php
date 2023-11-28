<?php

use App\Http\Controllers\Api\V1\SpecialtyController;
use App\Http\Controllers\Api\V1\SubjectController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::apiResource('subjects', SubjectController::class)->middleware('auth:sanctum')
        ->missing(function(){
            return response()->json(["message" => "Subject couldn't be found"], 404);
        });

    Route::apiResource('specialties', SpecialtyController::class)->middleware('auth:sanctum')
        ->missing(function(){
            return response()->json(["message" => "Specialty couldn't be found"], 404);
        });

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});
