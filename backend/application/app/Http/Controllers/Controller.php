<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function sucesso(array $data = [], string $message = 'Success')
    {
        return [
            "err" => false,
            "msg" => $message,
            "data" => $data
        ];
    }

    public function err(array $data = [], string $message = 'Error')
    {
        return [
            "err" => true,
            "msg" => $message,
            "data" => $data
        ];
    }
}
