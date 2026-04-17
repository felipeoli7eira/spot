<?php

use App\Features\Categoria\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('ping', fn() => response()->json([
    'err' => false,
    'msg' => 'pong',
]));

// Features

Route::prefix('/categorias')->group(function () {
    Route::post('/', [Controller::class, 'criar']);
    Route::get('/', [Controller::class, 'read']);
});
