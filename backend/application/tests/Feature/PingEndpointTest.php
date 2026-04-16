<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PingEndpointTest extends TestCase
{
    public function test_ping_endpoint_returns_correct_response(): void
    {
        $response = $this->get('/api/ping');

        $response->assertStatus(200);
        $response->assertJson([
            'err' => false,
            'msg' => 'pong',
        ]);
    }
}
