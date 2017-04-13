<?php


namespace App\Repositories\Ad;


use Adldap\Laravel\Facades\Adldap;
use App\Repositories\ComputerRepositoryInterface;

class AdComputerRepository implements ComputerRepositoryInterface
{
    public function getByName($name)
    {
        $adComputer = Adldap::search()->computers()->find($name);
        return $adComputer ? $this->mapAdComputerToComputer($adComputer) : null;
    }

    public function mapAdComputerToComputer($adComputer)
    {
    }
}