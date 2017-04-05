<?php

namespace Tests\Feature;

use Adldap\Laravel\Facades\Adldap;
use Tests\AdldapTestCase;

class SearchUserTest extends AdldapTestCase
{
    /** @test */
    public function it_finds_user_by_username_and_returns_json()
    {
        $user = ($this->make_fake_users())[0];
        Adldap::shouldReceive('search')->andReturn($this->mockedSearch);
        $this->mockedSearch->shouldReceive('users')->once()->andReturn($this->mockedBuilder);
        $this->mockedBuilder->shouldReceive('findBy')->once()->with('samaccountname', $user->samaccountname)->andReturn($user);
        $response = $this->get("/users?q={$user->samaccountname}");
        $response->assertStatus(200)->assertJsonFragment([
            'account' => $user->samaccountname,
            'firstName' => $user->givenName,
            'lastName' => $user->sn,
            'middleName' => $user->middleName,
            'mail' => $user->mail,
            'externalMail' => $user->homePhone,
            'internalPhone' => $user->telephoneNumber,
            'cityPhone' => $user->pager,
            'department' => $user->department,
            'enabled' => $user->isEnabled(),
        ]);
    }
}
