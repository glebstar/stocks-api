<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StockTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test Login
     *
     * @return string
     */
    public function test_login(): string
    {
        $response = $this->postJson ('api/auth/login', [
            'email' => 'test@example.com',
            'password' => '123456',
        ]);

        $this->assertTrue(isset($response['access_token']));

        return $response['access_token'];
    }

    /**
     * Test get for data
     *
     * @param string $token
     * @return void
     * @depends test_login
     */
    public function test_get_for_data(string $token): void
    {
        $response = $this->getJson('api/stock/get_for_data?token=' . $token);
        $response->assertStatus(200);
    }
}
