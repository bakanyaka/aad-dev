<?php


namespace App\Repositories;


interface UserRepositoryInterface
{
    public function getByAccount($account);
}