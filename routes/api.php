<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->get('/saludo', function () {
    try {
        $user = JWTAuth::parseToken()->authenticate();
        return ['mensaje' => 'Hola ' . $user->name . ', desde Laravel API con JWT'];
    } catch (TokenExpiredException $e) {
        return response()->json(['error' => 'Token expirado'], 401);
    }
});