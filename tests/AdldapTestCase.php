<?php

namespace Tests;

use Adldap\Laravel\Facades\Adldap;
use Adldap\Models\Computer;
use Adldap\Models\User;
use Adldap\Query\Builder;
use Adldap\Schemas\ActiveDirectory;
use Adldap\Utilities;
use Faker\Factory;

class AdldapTestCase extends TestCase
{

    protected $faker;
    protected $mockedBuilder;
    protected $mockedSearch;

    public function setUp()
    {

        parent::setUp();
        $this->faker = Factory::create('ru_RU');
        $this->mockedBuilder = $this->mock(Builder::class);
        $this->mockedBuilder->shouldReceive('getSchema')->andReturn(new ActiveDirectory);
        $this->mockedSearch = $this->mock(\Adldap\Search\Factory::class);
        Adldap::shouldReceive('search')->andReturn($this->mockedSearch);
    }

    public function make_fake_user($attributes = [])
    {
        $firstName = $this->faker->firstName('male');
        $lastName = $this->faker->lastName('male');
        $middleName = $this->faker->middleNameMale;
        $account = $this->faker->bothify('???#####');
        $user = (new User([], $this->mockedBuilder))->setRawAttributes([
            'name' => ["{$lastName} {$firstName} {$middleName}"],
            'givenname' => [$firstName],
            'middlename' => [$middleName],
            'sn' => [$lastName],
            'displayname' => ["{$lastName} {$firstName} {$middleName}"],
            'samaccountname' => [$account],
            'mail' => ["{$account}@arsenal.plm"],
            'homephone' => [$this->faker->email],
            'pager' => [$this->faker->numerify('292-4#-##')],
            'telephonenumber' => [$this->faker->numerify('##-##')],
            'mobile' => [$this->faker->numerify('+7(###)###-##-##')],
            'department' => ["{$this->faker->randomNumber($nbDigits = 3)} {$this->faker->sentence($nbWords = 6, $variableNbWords = true)}"],
            'title' => [$this->faker->jobTitle],
            'physicaldeliveryofficename' => [$this->faker->numerify('Здание ##, Этаж #, Комната ###')],
            'lastLogon' => [Utilities::convertUnixTimeToWindowsTime($this->faker->unixTime())],
            'useraccountcontrol' => [512]
        ]);
        return $user;
    }

    public function make_fake_users($count = 1)
    {
        $users = array();
        for ($i = 0; $i <= $count; $i++) {
            $users[] = $this->make_fake_user();
        }
        return $users;
    }

    public function make_fake_computer($attributes = [])
    {
        $computer = (new Computer([], $this->mockedBuilder))->setRawAttributes([
            'name' => [$this->faker->numerify("otd###-{$this->faker->dayOfMonth}{$this->faker->month}17##")],
            'description' => [array_key_exists('description', $attributes) ? $attributes['description'] : "{$this->make_fake_user()->samaccountname[0]} @ {$this->faker->dateTimeThisYear()->format('d.m.Y H:i:s')}"]
        ]);
        return $computer;
    }
}

