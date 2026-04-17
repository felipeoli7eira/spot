<?php

namespace App\Features\Categoria\Repositories;

use App\Features\Categoria\Repositories\Models\Categoria;
use Illuminate\Support\Str;

final class LaravelEloquenteModelMySQL
{
    public function __construct(public readonly Categoria $model) {}

    public function criar(string $nome, string $descricao, bool $status): array
    {
        $criado = $this->model->create([
            'uuid' => Str::uuid()->toString(),
            'nome' => $nome,
            'descricao' => $descricao,
            'status' => $status,
        ]);

        return $criado->toArray();
    }

    public function read(): array
    {
        $categorias = $this->model->all();

        return $categorias->toArray();
    }
}
