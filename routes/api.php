<?php

use App\Helpers\ResponseHelper;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tokens/create', function (Request $request) {
        return response()->json([
            'token' => $request->user()->createToken('auth_token')->plainTextToken,
        ]);
        $token = $request->user()->createToken($request->token_name);

        return ['token' => $token->plainTextToken];
    });

    Route::post('/auth/logout', [\App\Http\Controllers\API\AuthController::class, 'attemptLogout'])
        ->name('auth.logout');

    Route::apiResource('/users', \App\Http\Controllers\API\UserController::class)
        ->missing(function () {
            return ResponseHelper::notFound('User not found');
        });
});

Route::middleware('guest:sanctum')->group(function () {
    Route::post('/auth/login', [\App\Http\Controllers\API\AuthController::class, 'attemptLogin'])
        ->name('auth.login');

    Route::post('/auth/register', [\App\Http\Controllers\API\AuthController::class, 'attemptRegister'])
        ->name('auth.register');
});
