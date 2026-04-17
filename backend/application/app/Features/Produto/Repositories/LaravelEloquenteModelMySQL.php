<?php

namespace App\Features\Produto\Repositories;

use App\Features\Categoria\Repositories\Models\Categoria;
use App\Features\Produto\Repositories\Models\Produto;
use Illuminate\Support\Str;

final class LaravelEloquenteModelMySQL
{
    public function __construct(
        public readonly Produto $model,
        public readonly Categoria $categoria,
    ) {}

    public function criar(string $categoriaUuid, array $dados): array
    {
        $categoria = $this->categoria->where('uuid', $categoriaUuid)->first();

        $produto = $this->model->create([
            'uuid'         => Str::uuid()->toString(),
            'nome'         => $dados['nome'],
            'descricao'    => $dados['descricao'],
            'preco'        => $dados['preco'],
            'categoria_id' => $categoria->id,
        ]);

        return $produto->with(['categoria'])->first()->toArray();
    }

    public function listar(array $filtros): array
    {
        $query = $this->model->with([
            'categoria:id,nome,descricao,status'
        ]);

        if (empty($filtros)) {
            return $query->get()->toArray();
        }

        if (array_key_exists('uuid', $filtros)) {
            return [
                $query->where('uuid', $filtros['uuid'])->first()?->toArray()
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
        $produto = $this->model->with([
            'categoria:id,nome,descricao,status'
        ])->where('uuid', $uuid)->first();

        if (array_key_exists('categoria', $novosDados)) {
            $categoria = $this->categoria->where('uuid', $novosDados['categoria'])->first();

            unset($novosDados['categoria']);

            $produto->categoria_id = $categoria->id;
        }

        $produto->fill($novosDados);

        $produto->save();

        return [
            $produto->toArray()
        ];
    }
}
