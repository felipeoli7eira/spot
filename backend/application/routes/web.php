<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => response()->json([
    'err' => false,
    'msg' => 'Bem-vindo à API de Categorias',
    'data' => null,
]));
