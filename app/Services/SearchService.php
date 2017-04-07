<?php


namespace App\Services;


use App\Repositories\UserRepositoryInterface;

class SearchService
{
    protected $users;

    /**
     * SearchService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->users = $userRepository;
    }

    public function findUser($query)
    {
        $users = collect();
        $user = $this->users->getByAccount($query);
        if ($user) {
            $users->push($user);
        }
        return $users;
    }
}