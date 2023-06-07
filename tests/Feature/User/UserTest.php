<?php

namespace Tests\Feature\User;

use App\Models\Permission\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_unauthenticated(): void
    {
        $response = $this->getJson('/api/user');
        $response->assertStatus(401);
    }

    public function test_get_users(): void
    {
        $user  = User::factory()->create();
        $token = $user->createToken("teste")->plainTextToken;
        $response = $this
                        ->withHeaders([
                            'Authorization' => "Bearer {$token}"
                        ])
                        ->getJson('/api/user');    
        $response->assertStatus(200);
    }

    public function test_count_users()
    {
        User::factory()->count(10)->create();
        $user = User::first();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this
                        ->withHeaders([
                            'Authorization' => "Bearer {$token}"
                        ])
                        ->getJson('/api/user');
        $response->assertJsonCount(10, 'data');
        $response->assertStatus(200);
    }

    public function test_get_user()
    {
        
        $user = User::factory()->create();
        
        $token = $user->createToken('test')->plainTextToken;
        
        $response = $this
                        ->withHeaders([
                            'Authorization' => "Bearer {$token}"
                        ])
                        ->getJson("/api/user/{$user->uuid}");
        
        $response->assertStatus(200);
    }

    public function test_fail_get_user()
    {
        $user = User::factory()->create();
        
        $token = $user->createToken('test')->plainTextToken;
        
        $response = $this
                        ->withHeaders([
                            'Authorization' => "Bearer {$token}"
                        ])
                        ->getJson("/api/user/fake_value");
        $response->assertStatus(404);
    }

    public function test_validations_store_user()
    {
    
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this
                        ->withHeaders([
                            'Authorization' => "Bearer {$token}"
                        ])
                        ->postJson('/api/user', []);
                        
        $response->assertStatus(422);
    }

    public function test_store_user()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;
        $response = $this
                        ->withHeaders([
                            'Authorization' => "Bearer {$token}"
                        ])
                        ->postJson('/api/user', [
                            'name' => 'Matheus Sodre',
                            'email' => 'matheus.sodree@gmail.com',
                            'password' => '12345678',
                        ]);
                        
        $response->assertStatus(201);
    }

    public function test_validation_404_update_user()
    {
    
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this
                        ->withHeaders([
                            'Authorization' => "Bearer {$token}"
                        ])
                        ->putJson('/api/user/fake_user', [
                            'name' => 'matheus sodre',
                            'email' => 'matheus@gmail.com'
                        ]);
                        
        $response->assertStatus(404);
    }

    public function test_validations_update_user()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this
                        ->withHeaders([
                            'Authorization' => "Bearer {$token}"
                        ])
                        ->putJson("/api/user/{$user->uuid}", []);
                        
        $response->assertStatus(422);
    }

    public function test_update_user()
    {

        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this
                        ->withHeaders([
                            'Authorization' => "Bearer {$token}"
                        ])
                        ->putJson("/api/user/{$user->uuid}", [
                            'name' => 'User Updated',
                            'email' => 'update@teste.com.br',
                        ]);
                        
        $response->assertStatus(200);
    }

    public function test_validation_404_delete_user()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this
                        ->withHeaders([
                            'Authorization' => "Bearer {$token}"
                        ])
                        ->deleteJson('api/user/fake_user');
                        
        $response->assertStatus(404);
    }

    public function test_delete_user()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test')->plainTextToken;

        $response = $this
                        ->withHeaders([
                            'Authorization' => "Bearer {$token}"
                        ])
                        ->deleteJson("api/user/{$user->uuid}");
                        
        $response->assertStatus(200);
    }
}
