<?php

namespace Feature;
use Adldap\Laravel\Facades\Adldap;
use Tests\AdldapTestCase;

class SearchComputerTest extends AdldapTestCase
{
    /** @test */
    public function it_finds_computer_by_name()
    {
        $this->disableExceptionHandling();
        $computer = $this->make_fake_computer();
        Adldap::shouldReceive('search')->andReturn($this->mockedSearch);
        $this->mockedSearch->shouldReceive("computers->find")->with($computer->getName())->andReturn($computer);

        $response = $this->get("/api/computers/{$computer->getName()}");

        $response->assertJsonFragment([
            'name' => $computer->getName(),
        ]);
    }

}
