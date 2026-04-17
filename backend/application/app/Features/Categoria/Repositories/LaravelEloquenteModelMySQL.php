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

    public function listar(array $filtros): array
    {
        if (sizeof($filtros) === 0) {
            return $this->model->all()->toArray();
        }

        if (array_key_exists('uuid', $filtros)) {
            return [
                $this->model->where('uuid', $filtros['uuid'])->first()->toArray()
            ];
        }

        return [];
    }

    public function deletar(string $uuid): bool
    {
        return $this->model->where('uuid', $uuid)->delete();
    }


    public function atualizar(string $uuid, $novosDados): array
    {
        $categoria = $this->model->where('uuid', $uuid)->first();

        $categoria->fill($novosDados);

        $categoria->save();

        return [
            $categoria->toArray()
        ];
    }
}
