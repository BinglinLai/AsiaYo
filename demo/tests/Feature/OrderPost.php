<?php

namespace Tests\Feature;

use Tests\TestCase;

class OrderPost extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function SuccessfulTest()
    {
        $response = $this->post(
            '/api/orders',
            [
                'id' => 'A0000001',
                'name' => 'Melody Holiday Inn',
                'address' => [
                    'city' => 'taipei-city',
                    'district' => 'da-an-district',
                    'street' => 'fuxing-south-road',
                ],
                'price' => '2050',
                'currency' => 'TWD',
            ],
            [
                'Accept' => 'application/json',
            ]
        );

        $response->assertStatus(200);
    }
    
    public function FailedTest()
    {
        $response = $this->post(
            '/api/orders',
            [
                'id' => 'A0000001',
                'name' => 'Melody Holiday Inn',
                'address' => [
                    'city' => 'taipei-city',
                    'district' => 'da-an-district',
                    'street' => 'fuxing-south-road',
                ],
                'price' => '2050',
                'currency' => 'TWDD',
            ],
            [
                'Accept' => 'application/json',
            ]
        );

        $response->assertStatus(422);
    }
}
