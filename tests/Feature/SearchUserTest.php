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
            'name' => $user->name[0],
            'displayName' => $user->displayname[0],
            'firstName' => $user->givenname[0],
            'lastName' => $user->sn[0],
            'middleName' => $user->middlename[0],
            'title' => $user->title[0],
            'mail' => $user->mail[0],
            'externalMail' => $user->homephone[0],
            'localPhone' => $user->telephonenumber[0],
            'cityPhone' => $user->pager[0],
            'mobilePhone' => $user->mobile[0],
            'department' => $user->department[0],
            'office' => $user->physicaldeliveryofficename[0],
            'enabled' => $user->isEnabled(),
        ]);
    }
}
