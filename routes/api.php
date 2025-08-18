<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\ProductController;

// 🔹 Login sin proteger
Route::post('/login', [AuthController::class, 'login']);

// 🔹 Rutas protegidas con JWT
Route::middleware('auth:api')->group(function () {

    // ---- Usuarios ----
    Route::get('/usuarios', [UserController::class, 'index']);
    Route::post('/usuarios', [UserController::class, 'store']);
    Route::put('/usuarios/{id}', [UserController::class, 'update']);

    // ---- Categorías ----
    Route::apiResource('categories', CategoryController::class);

    // ---- Marcas ----
    Route::apiResource('brands', BrandController::class);

    // ---- Productos ----
    Route::apiResource('products', ProductController::class);

    // ---- Saludo de prueba ----
    Route::get('/saludo', function () {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            return ['mensaje' => 'Hola ' . $user->name . ', desde Laravel API con JWT'];
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'Token expirado'], 401);
        }
    });
});