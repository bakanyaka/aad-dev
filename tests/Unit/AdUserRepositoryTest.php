<?php

namespace Tests\Unit;

use App\Repositories\Ad\AdUserRepository;
use Tests\AdldapTestCase;

class AdUserRepositoryTest extends AdldapTestCase
{
    /**
     * A basic test example.
     *
     * @test
     * @return void
     */
    public function it_correctly_maps_all_attributes_of_adldap2_user_model_to_user_model()
    {
        $adUser = ($this->make_fake_users(1))[0];
        $adUserRepository = new AdUserRepository();
        $user = $adUserRepository->mapAdUserToUser($adUser);

        $this->assertEquals($adUser->samaccountname[0], $user->account);
        $this->assertEquals($adUser->name[0], $user->name);
        $this->assertEquals($adUser->displayname[0], $user->displayName);
        $this->assertEquals($adUser->givenname[0], $user->firstName);
        $this->assertEquals($adUser->sn[0], $user->lastName);
        $this->assertEquals($adUser->middlename[0], $user->middleName);
        $this->assertEquals($adUser->title[0], $user->title);
        $this->assertEquals($adUser->telephonenumber[0], $user->localPhone);
        $this->assertEquals($adUser->pager[0], $user->cityPhone);
        $this->assertEquals($adUser->mobile[0], $user->mobilePhone);
        $this->assertEquals($adUser->physicaldeliveryofficename[0], $user->office);
    }
}
