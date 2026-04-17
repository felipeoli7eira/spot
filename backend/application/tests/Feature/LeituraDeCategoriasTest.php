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
}
