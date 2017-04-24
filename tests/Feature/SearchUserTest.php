<?php

namespace Tests\Feature;

use Adldap\Laravel\Facades\Adldap;
use Tests\AdldapTestCase;

class SearchUserTest extends AdldapTestCase
{
    /** @test */
    public function it_fetches_all_users() {
        $users = $this->make_fake_users(1200);
        $this->disableExceptionHandling();
        $this->mockedSearch->shouldReceive('users')->once()->andReturn($this->mockedBuilder);
        $this->mockedBuilder->shouldReceive('paginate->getResults')->once()->andReturn(collect($users));
        $response = $this->get("/api/users/");
        $response->assertStatus(200);
    }

    /** @test */
    public function it_finds_user_by_username_and_returns_json()
    {
        $this->disableExceptionHandling();
        $user = $this->make_fake_user();
        $this->mockedSearch->shouldReceive('users')->once()->andReturn($this->mockedBuilder);
        $this->mockedBuilder->shouldReceive('findBy')->once()->with('samaccountname', $user->samaccountname[0])->andReturn($user);
        $response = $this->get("/api/users/search?q={$user->samaccountname[0]}");
        $response->assertStatus(200)->assertJsonFragment([
            'account' => $user->samaccountname[0],
            'name' => $user->getName(),
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

    /** @test */
    public function it_finds_user_by_partial_name()
    {
        $this->disableExceptionHandling();
        $user = $this->make_fake_user();
        $this->mockedSearch->shouldReceive('users')->andReturn($this->mockedBuilder);
        $this->mockedBuilder->shouldReceive('whereContains')->with('name', $user->sn[0])->andReturnSelf();
        $this->mockedBuilder->shouldReceive('where')->with('name', 'contains', $user->sn[0])->andReturnSelf();
        $this->mockedBuilder->shouldReceive('get')->andReturn(collect([$user]));
        $response = $this->get("/api/users/search?q={$user->sn[0]}");
        $response->assertStatus(200)->assertJsonFragment(['account' => $user->samaccountname[0]]);
    }

    /** @test */
    public function it_finds_user_by_computer_name()
    {
        $this->disableExceptionHandling();
        $user = $this->make_fake_user();
        $computer = $this->make_fake_computer(["description" => "{$user->samaccountname[0]} @ {$this->faker->dateTimeThisYear()->format('d.m.Y H:i:s')}" ]);
        $this->mockedSearch->shouldReceive("computers->find")->with($computer->getName())->andReturn($computer);
        $this->mockedSearch->shouldReceive("users->findBy")->once()->with('samaccountname', $user->samaccountname[0])->andReturn($user);
        $response = $this->get("/api/users/search?q={$computer->getName()}");
        $response->assertStatus(200)->assertJsonFragment(['account' => $user->samaccountname[0]]);
    }

    /** @test */
    public function it_returns_json_with_empty_data_array_when_no_user_is_found()
    {
        $this->mockedSearch->shouldReceive('users')->andReturn($this->mockedBuilder);
        $this->mockedBuilder->shouldReceive('findBy')->andReturn(null);
        $this->mockedBuilder->shouldReceive('whereContains')->andReturnSelf();
        $this->mockedBuilder->shouldReceive('where')->andReturnSelf();
        $this->mockedBuilder->shouldReceive('get')->andReturn(collect());

        $response = $this->get("/api/users/search?q=xxx99999");
        $response->assertStatus(200)->assertExactJson(["data" => []]);
        $response = $this->get("/api/users/search?q=какаятофамилия");
        $response->assertStatus(200)->assertExactJson(["data" => []]);
    }
}
