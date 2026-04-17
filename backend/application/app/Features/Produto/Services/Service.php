<?php

namespace App\Features\Produto\Services;

use App\Features\Produto\Repositories\LaravelEloquenteModelMySQL;

final class Service
{
    public function __construct(
        public readonly LaravelEloquenteModelMySQL $repositorio,
    ) {}

    public function criar(string $categoriaUuid, array $dados): array
    {
        $produto = $this->repositorio->criar(
            $categoriaUuid,
            $dados
        );

        $produto['dt_criacao'] = now()->createFromDate($produto['created_at'])->format('d/m/Y H:i');
        $produto['dt_atualizacao'] = now()->createFromDate($produto['updated_at'])->format('d/m/Y H:i');

        unset($produto['created_at']);
        unset($produto['updated_at']);

        unset($produto['categoria']['created_at']);
        unset($produto['categoria']['updated_at']);

        return $produto;
    }

    // public function listar(array $filtros): array
    // {
    //     $categorias = $this->repositorio->listar(
    //         $filtros
    //     );

    //     return collect($categorias)->map(function ($categoria) {
    //         $categoria['dt_criacao'] = now()->createFromDate($categoria['created_at'])->format('d/m/Y H:i');
    //         $categoria['dt_atualizacao'] = now()->createFromDate($categoria['updated_at'])->format('d/m/Y H:i');

    //         unset($categoria['created_at']);
    //         unset($categoria['updated_at']);

    //         return $categoria;
    //     })->toArray();
    // }

    // public function deletar(string $uuid): bool
    // {
    //     return $this->repositorio->deletar($uuid);
    // }

    // public function atualizar(string $uuid, array $dados): array
    // {
    //     $categoria = $this->repositorio->atualizar(
    //         $uuid,
    //         $dados
    //     );

    //     return collect($categoria)->map(function ($categoria) {
    //         $categoria['dt_criacao'] = now()->createFromDate($categoria['created_at'])->format('d/m/Y H:i');
    //         $categoria['dt_atualizacao'] = now()->createFromDate($categoria['updated_at'])->format('d/m/Y H:i');

    //         unset($categoria['created_at']);
    //         unset($categoria['updated_at']);

    //         return $categoria;
    //     })->first();
    // }
}
