<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserAuthTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_can_login_with_valid_credentials()
    {
        list(, , $response) = $this->createUserAndLogin();
        $response->assertJsonStructure([
            'data',
            'meta' => ['token']
        ]);
    }

    /** @test */
    public function user_cant_login_with_invalid_credentials()
    {
        $response = $this->json('POST', '/api/login', ['username' => 'invaliduser', 'password' => 'secret']);
        $response->assertStatus(401);
        $response->assertJsonStructure(['errors' => ['root']]);
    }

    /** @test */
    public function user_can_retrieve_own_details()
    {
        list($user, $token) = $this->createUserAndLogin();
        $response = $this->getJson('/api/me', ['Authorization' => "Bearer {$token}"]);
        $response->assertStatus(200);
        $response->assertJsonFragment([
           'username' => $user->username
        ]);
    }

    /** @test */
    public function user_cant_access_protected_page_with_invalid_token()
    {
        $someRandomJWTToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiYWRtaW4iOnRydWUsImp0aSI6IjJmOTMyNzM3LWQzNTMtNDhkYS1iNmIwLTQyNjc0Yjg4N2UwMiIsImlhdCI6MTQ5MjQ0ODU0MCwiZXhwIjoxNDkyNDUyMTQwfQ.c6dcrtFgWzPvJ8ouPXkIiyf0rmp5GBHoKofDqCT__MM";
        $response = $this->getJson('/api/me', ['Authorization' => "Bearer {$someRandomJWTToken}"]);
        $response->assertStatus(400);
        $response->assertJsonFragment([
            "error" => "token_invalid"
        ]);
    }

    /** @test */
    public function user_cant_access_protected_page_after_logging_out()
    {
        list(, $token) = $this->createUserAndLogin();
        $response = $this->get('/api/logout',['Authorization' => "Bearer {$token}"]);
        $response->assertStatus(200);
        $response = $this->getJson('/api/me', ['Authorization' => "Bearer {$token}"]);
        $response->assertStatus(401);
        $response->assertJsonFragment([
            "error" => "token_invalid"
        ]);
    }

    /**
     * @return array
     */
    protected function createUserAndLogin()
    {
        $user = factory(User::class)->create();
        $response = $this->json('POST', '/api/login', ['username' => $user->username, 'password' => 'secret']);
        $response->assertStatus(200);
        $token = $response->decodeResponseJson()['meta']['token'];
        return array($user, $token, $response);
    }
}
