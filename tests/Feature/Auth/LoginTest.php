<?php

namespace Tests\Feature\Auth;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_valid_credentials ()
    {
        $user = factory(User::class)->create();
        $response = $this->json('POST', '/auth/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);
        $response->assertOk();
        $response->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_use_invalid_credentials ()
    {
        $response = $this->json('POST', '/auth/login', [
           'email' => 'invalid-email',
           'password' => 'x'
        ]);

        $response->assertJsonMissing(['access_token']);
        $response->assertStatus(401);
    }

    public function test_user_can_refresh_token ()
    {
        $user = factory(User::class)->create();
        $response = $this->addLoginHeader($user)->json('POST', '/auth/refresh');
        $response->assertOk();
        $response->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }
}
