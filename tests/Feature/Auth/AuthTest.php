<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_validations_auth()
    {
        $response = $this->postJson('/api/auth', []);

        $response->assertStatus(422);
    }

    public function test_error_password_auth()
    {
        User::factory()->create([
            'email' => 'matheus@gmail.com'
        ]);

        $response = $this->postJson('/api/auth', [
            'email' => 'matheus@gmail.com',
            'password' => 'fakepassword',
            'device_name' => 'test'
        ]);

        $response->assertStatus(422);
    }

    public function test_auth()
    {
        $user = User::factory()->create([
            'email' => 'matheus@gmail.com'
        ]);

        $response = $this->postJson('/api/auth', [
            'email' => 'matheus@gmail.com',
            'password' => 'password',
            'device_name' => 'test'
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
        
        $response->assertStatus(200);
    }

    public function test_error_logout()
    {
        $response = $this->postJson('/api/logout');

        $response->assertStatus(401);
    }

    public function test_logout()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this
                        ->withHeaders([
                            'Authorization' => "Bearer {$token}"
                        ])
                        ->postJson('/api/logout');

        $response->assertStatus(200);
    }

}
