<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_good_credentials()
    {
        $user = User::factory()->create();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/login', ['email' => $user->email, 'password' => 'password']);

        $response->assertStatus(200);
    }

    public function test_login_bad_credentials()
    {
        $user = User::factory()->create();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/login', ['email' => $user->email, 'password' => 'Passw']);

        $response->assertStatus(422);
    }
}
