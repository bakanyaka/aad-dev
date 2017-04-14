<?php


namespace App\Repositories;


interface ComputerRepositoryInterface
{
    public function getByName($name);
    public function getByUsername($username);
}