<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeituraDeCategoriasTest extends TestCase
{
    use RefreshDatabase;

    public function test_categoria_podem_ser_listadas(): void
    {
        $response = $this->get('/api/categorias');

        $response->assertOk();
        $response->assertJsonStructure([
            'err',
            'msg',
            'data'
        ]);
    }

    public function test_categoria_podem_ser_listadas_por_uuid(): void
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

        $leituraPorUuid = $this->get('/api/categorias?uuid=' . $categoria->json('data')['uuid']);

        $leituraPorUuid->assertOk();
        $leituraPorUuid->assertJsonStructure([
            'err',
            'msg',
            'data',
        ]);
    }
}
