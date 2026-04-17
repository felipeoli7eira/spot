<?php

namespace App\Features\Categoria\Services;

use App\Features\Categoria\Repositories\LaravelEloquenteModelMySQL;
use InvalidArgumentException;

final class Service
{
    public function __construct(
        public readonly LaravelEloquenteModelMySQL $repositorio,
    ) {}

    public function criar(string $nome, string $descricao, ?bool $status = true): array
    {
        $categoria  = $this->repositorio->criar(
            nome: $nome,
            descricao: $descricao,
            status: $status,
        );


        $categoria['dt_criacao'] = now()->createFromDate($categoria['created_at'])->format('d/m/Y H:i');
        $categoria['dt_atualizacao'] = now()->createFromDate($categoria['updated_at'])->format('d/m/Y H:i');

        unset($categoria['created_at']);
        unset($categoria['updated_at']);

        return $categoria;
    }
}
