<?php

namespace Tests\Feature;

use Adldap\Models\User;
use Adldap\Query\Builder;
use Adldap\Schemas\ActiveDirectory;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchUserTest extends TestCase
{

    protected $faker;
    protected $mockedBuilder;

    public function setUp()
    {

        parent::setUp();
        $this->faker = Factory::create('ru_RU');
        $this->mockedBuilder = $this->mock(Builder::class);
        $this->mockedBuilder->shouldReceive('getSchema')->andReturn(new ActiveDirectory);
    }

    public function make_fake_user($count = 1)
    {
        $users = array();
        for ($i = 0; $i < $count; $i++) {
            $firstName = $this->faker->firstName('male');
            $lastName = $this->faker->lastName('male');
            $middleName = $this->faker->middleNameMale;
            $users[] = (new User([], $this->mockedBuilder))->setRawAttributes([
                'name' => "{$lastName} {$firstName} {$middleName}",
                'givenName' => $firstName,
                'middleName' => $middleName,
                'sn' => $lastName,
                'displayname' => "{$lastName} {$firstName} {$middleName}",
                'samaccountname' => $this->faker->bothify('???#####'),
                'department' => "{$this->faker->randomNumber($nbDigits = 3)} {$this->faker->sentence($nbWords = 6, $variableNbWords = true)}",
                'useraccountcontrol' => 512
            ]);
        }
        return $users;
    }

    /** @test */
    public function it_finds_user_by_username_and_returns_json()
    {
        $user = $this->make_fake_user();
        dd($user);
    }
}
