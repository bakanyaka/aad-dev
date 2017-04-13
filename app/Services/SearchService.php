<?php


namespace App\Services;


use App\Repositories\ComputerRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class SearchService
{
    /**
     * @var UserRepositoryInterface
     */
    protected $users;
    /**
     * @var ComputerRepositoryInterface
     */
    protected $computers;

    /**
     * SearchService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param ComputerRepositoryInterface $computerRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, ComputerRepositoryInterface $computerRepository)
    {
        $this->users = $userRepository;
        $this->computers = $computerRepository;
    }

    /**
     * @param $query
     * @return \Illuminate\Support\Collection
     */
    public function findUser($query)
    {
        if(preg_match('/^[A-z]{2,4}\d{0,3}-\d{2,}/',$query)) {
            return $this->findUserByComputer($query);
        } else if (preg_match('/^[a-z]{0,5}\d{4,6}/', $query)) {
            $user = $this->users->getByAccount($query);
            return ($user) ? collect([$user]) : collect();
        } else {
            return $this->users->findByName($query);
        }
    }

    /**
     * @param $computerName
     * @return \Illuminate\Support\Collection
     */
    public function findUserByComputer($computerName)
    {
        $computer = $this->computers->getByName($computerName);
        $lastLoggedOnUser = $computer->lastLoggedOnUser();
        return ($lastLoggedOnUser) ? collect([$lastLoggedOnUser]) : collect();
    }
}