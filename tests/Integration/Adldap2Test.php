<?php


namespace Tests\Integration;


use Adldap\Laravel\Facades\Adldap;
use Tests\TestCase;

class Adldap2Test extends TestCase
{
    /** @test */
    function it_connects_to_active_directory() {
        try {
            $provider = Adldap::getDefaultProvider()->connect();
        } catch (\Adldap\Auth\BindException $e) {
            $this->fail('Can\'t contact LDAP server');
        }
    }
}
