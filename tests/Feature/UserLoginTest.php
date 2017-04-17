<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserLoginTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function user_can_login_with_valid_credentials()
    {
        $this->disableExceptionHandling();
        $user = factory(User::class)->create(['username' => 'testuser']);
        $response = $this->json('POST', '/api/login', ['username' => 'testuser', 'password' => 'secret']);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'meta' => ['token']
        ]);
    }

    /** @test */
    public function user_cant_login_with_invalid_credentials()
    {
        $this->disableExceptionHandling();
        $response = $this->json('POST', '/api/login', ['username' => 'invaliduser', 'password' => 'secret']);
        $response->assertStatus(401);
        $response->assertJsonStructure(['errors' => ['root']]);
    }

}
