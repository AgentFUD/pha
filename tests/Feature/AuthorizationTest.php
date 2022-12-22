<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Player;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_we_cant_access_endpoint_without_authorization()
    {
        $this->seed();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->get('/api/player/1');

        $response->assertUnauthorized();
    }

    public function test_we_can_access_endpoint_with_authorization()
    {

        $user = User::factory()->create();
        $player = Player::factory()->create();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/login', ['email' => $user->email, 'password' => 'password']);

        $token = $response->getContent();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . substr($token, 2),
        ])->get('/api/player/3');
        $response->assertStatus(200);
        $response->assertSee($player->email);
    }
}
