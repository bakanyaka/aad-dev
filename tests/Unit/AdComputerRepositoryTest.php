<?php

namespace Tests\Unit;

use App\Repositories\Ad\AdComputerRepository;
use Tests\AdldapTestCase;

class AdComputerRepositoryTest extends AdldapTestCase
{
    /** @test */
    public function it_correctly_maps_all_attributes_of_adldap2_computer_model_to_computer_model()
    {
        $user = $this->make_fake_user();
        $adComputer = $this->make_fake_computer(["description" => "{$user->samaccountname[0]} @ {$this->faker->dateTimeThisYear()->format('d.m.Y H:i:s')}" ]);
        $adComputerRepository = new AdComputerRepository();
        $computer = $adComputerRepository->mapAdComputerToComputer($adComputer);
        $this->assertEquals($adComputer->getName(), $computer->name);
        $this->assertEquals($user->samaccountname[0], $computer->lastLoggedOnUserAccount);

    }

}
