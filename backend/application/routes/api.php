<?php

use Illuminate\Support\Facades\Route;

use App\Features\Categoria\Controllers\Controller;
use App\Features\Produto\Controllers\Controller as ProdutoController;

Route::get('ping', fn() => response()->json([
    'err' => false,
    'msg' => 'pong',
]));

// Features

Route::prefix('/categorias')->group(function () {
    Route::post('/', [Controller::class, 'criar']);
    Route::get('/', [Controller::class, 'listar']);
    Route::delete('/{uuid}', [Controller::class, 'deletar']);
    Route::patch('/{uuid}', [Controller::class, 'atualizar']);
});

Route::prefix('/produtos')->group(function () {
    Route::post('/', [ProdutoController::class, 'criar']);
    Route::get('/', [ProdutoController::class, 'listar']);
    Route::delete('/{uuid}', [ProdutoController::class, 'deletar']);
    Route::patch('/{uuid}', [ProdutoController::class, 'atualizar']);
});
