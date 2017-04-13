<?php


namespace App\Repositories\Ad;


use Adldap\Laravel\Facades\Adldap;
use App\Models\Ad\Computer;
use App\Repositories\ComputerRepositoryInterface;

class AdComputerRepository implements ComputerRepositoryInterface
{
    public function getByName($name)
    {
        $adComputer = Adldap::search()->computers()->find($name);
        return $adComputer ? $this->mapAdComputerToComputer($adComputer) : null;
    }

    public function mapAdComputerToComputer(\Adldap\Models\Computer $adComputer)
    {
        $computer = new Computer();
        $computer->name = $adComputer->getName();
        return $computer;

    }
}