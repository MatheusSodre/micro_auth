<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    
     public function test_validations_register()
    {
        $response = $this->postJson('/api/register', []);

        $response->assertStatus(422);
    }

    public function test_register()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Matheus Sodré',
            'email' => 'matheus@gmail.com',
            'password' => '12345678',
            'device_name' => 'test',
        ]);

        $response->assertJsonStructure([
            'data' => [
                'identify',
                'name',
                'email',
                'permissions' => []
            ],
            'token'
        ]);

        $response->assertStatus(201);
    }
}
