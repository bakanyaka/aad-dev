<?php


namespace App\Repositories\Ad;


use Adldap\Laravel\Facades\Adldap;
use App\Models\Ad\Computer;
use App\Repositories\ComputerRepositoryInterface;
use Faker\Provider\DateTime;

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
        $lastLogon = $this->parseUserLoginData($adComputer->getDescription());
        $computer->lastLoggedOnUserAccount = $lastLogon ? $lastLogon[0]['account'] : null;
        return $computer;
    }

    private function parseUserLoginData($loginDataString)
    {
        preg_match_all('/(\w+)\s@\s(\d{2}.\d{2}.\d{4}\s\d{1,2}:\d{2}:\d{2})/', $loginDataString, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $logons[] = [
                'account' => $match[1],
                'date' => date_create_from_format('d.m.Y H:i:s', $match[2])
            ];
        }
        return $logons;
    }
}