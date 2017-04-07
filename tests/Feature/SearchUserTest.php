<?php

namespace Tests\Feature;

use Adldap\Laravel\Facades\Adldap;
use Tests\AdldapTestCase;

class SearchUserTest extends AdldapTestCase
{
    /** @test */
    public function it_finds_user_by_username_and_returns_json()
    {
        $this->disableExceptionHandling();
        $user = ($this->make_fake_users())[0];
        Adldap::shouldReceive('search')->andReturn($this->mockedSearch);
        $this->mockedSearch->shouldReceive('users')->once()->andReturn($this->mockedBuilder);
        $this->mockedBuilder->shouldReceive('findBy')->once()->with('samaccountname', $user->samaccountname[0])->andReturn($user);
        $response = $this->get("/api/users/search?q={$user->samaccountname[0]}");
        $response->assertStatus(200)->assertJsonFragment([
            'account' => $user->samaccountname[0],
            'firstName' => $user->givenName[0],
            'lastName' => $user->sn[0],
            'middleName' => $user->middleName[0],
            'mail' => $user->mail[0],
            'externalMail' => $user->homePhone[0],
            'internalPhone' => $user->telephoneNumber[0],
            'cityPhone' => $user->pager[0],
            'department' => $user->department[0],
            'enabled' => $user->isEnabled(),
        ]);
    }
}
