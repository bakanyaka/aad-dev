<?php

namespace Feature;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\AdldapTestCase;

class SearchComputerTest extends AdldapTestCase
{
    use WithoutMiddleware;
    /** @test */
    public function it_fetches_computer_by_name()
    {
        $this->disableExceptionHandling();
        $computer = $this->make_fake_computer();
        $this->mockedSearch->shouldReceive("computers->find")->with($computer->getName())->andReturn($computer);

        $response = $this->get("/api/computers/{$computer->getName()}");

        $response->assertJsonFragment([
            'name' => $computer->getName(),
        ]);
    }

    /** @test */
    public function it_returns_404_response_when_no_computer_found_by_name() {
        $this->mockedSearch->shouldReceive("computers->find")->andReturn(null);

        $response = $this->get("/api/computers/{nonexistingname}");

        $response->assertStatus(404);
    }

    /** @test */
    public function it_finds_computer_by_username()
    {
        $user = $this->make_fake_user();
        $computer = $this->make_fake_computer(["description" => "{$user->samaccountname[0]} @ {$this->faker->dateTimeThisYear()->format('d.m.Y H:i:s')}" ]);
        $this->mockedSearch->shouldReceive("computers")->andReturn($this->mockedBuilder);
        $this->mockedBuilder->shouldReceive("whereStartsWith")->with('description', $user->samaccountname[0])->andReturnSelf();
        $this->mockedBuilder->shouldReceive('get')->andReturn(collect([$computer]));

        $response = $this->get("api/computers/search?username={$user->samaccountname[0]}");

        $response->assertJsonFragment([
            'name' => $computer->getName(),
        ]);

    }

}
