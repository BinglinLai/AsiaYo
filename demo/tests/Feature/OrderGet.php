<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderGet extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function SuccessfulTest()
    {
        $response = $this->get('/api/orders/A0000001', [
            'Accept' => 'application/json',
        ]);

        $response->assertStatus(200);
    }
}
