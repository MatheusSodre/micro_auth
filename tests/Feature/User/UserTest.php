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
}
