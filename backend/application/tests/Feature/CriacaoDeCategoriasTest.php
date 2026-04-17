<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CriacaoDeCategoriasTest extends TestCase
{
    use RefreshDatabase;

    public function test_categoria_pode_ser_criada_com_parametros_corretos(): void
    {
        $response = $this->postJson('/api/categorias', [
            'nome'      => fake()->word(),
            'descricao' => fake()->sentence(),
            'status'    => fake()->boolean(),
        ]);

        $response->assertCreated();
        $response->assertJsonStructure([
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
    }

    public function test_categoria_nao_pode_ser_criada_com_parametros_incorretos(): void
    {
        $response = $this->postJson('/api/categorias', [
            'nome'      => fake()->word(),

            'descricao' => "", // ! Descrição vazia

            'status'    => fake()->boolean(),
        ]);

        $response->assertBadRequest();
        $response->assertJsonStructure([
            'err',
            'msg',
            'data',
        ]);
    }
}
