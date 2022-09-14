<?php

use Illuminate\Support\Facades\Request;

Route::controller(\App\Http\Controllers\ProductController::class)->prefix('products')->group(function (\Illuminate\Routing\Router $router) {
    $router->get('', 'index');
});

Route::controller(\App\Http\Controllers\OrderController::class)->middleware('auth:sanctum')->prefix('orders')->group(function (\Illuminate\Routing\Router $router) {
    $router->post('', 'store');
});

Route::controller(\App\Http\Controllers\UserController::class)->group(function (\Illuminate\Routing\Router $router) {
    $router->post('/auth', 'auth');
    $router->post('/register', 'store');
    $router->get('/user', function (\Illuminate\Http\Request $request) {
        return response()->json($request->user());
    });
    $router->get('/my-orders', 'orders')->middleware('auth:sanctum');
});
