<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DelecaoDeCategoriasTest extends TestCase
{
    use RefreshDatabase;

    public function test_categoria_pode_ser_deletada_por_uuid(): void
    {
        $categoria = $this->postJson('/api/categorias', [
            'nome'      => fake()->word(),
            'descricao' => fake()->sentence(),
            'status'    => fake()->boolean(),
        ]);

        $categoria->assertCreated();
        $categoria->assertJsonStructure([
            'err',
            'msg',
            'data' => [
                'uuid',
                'nome',
                'descricao',
                'status',
                'dt_criacao',
                'dt_atualizacao',
            ],
        ]);

        $delecaoPorUuid = $this->delete('/api/categorias/' . $categoria->json('data')['uuid']);

        $delecaoPorUuid->assertNoContent();
    }
}
