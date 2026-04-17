<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AtualizacaoDeCategoriasTest extends TestCase
{
    use RefreshDatabase;

    public function test_categoria_pode_ser_atualizada_por_uuid(): void
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

        $atualizacaoPorUuid = $this->patchJson('/api/categorias/' . $categoria->json('data')['uuid'], [
            'nome'      => fake()->word(),
            'descricao' => fake()->sentence(),
            'status'    => fake()->boolean(),
        ]);

        $atualizacaoPorUuid->assertOk();
        $atualizacaoPorUuid->assertJsonStructure([
            'err',
            'msg',
            'data',
        ]);
    }
}
