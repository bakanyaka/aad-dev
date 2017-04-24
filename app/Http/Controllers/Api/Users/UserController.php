<?php

namespace App\Http\Controllers\Api\Users;

use App\Repositories\UserRepositoryInterface;
use App\Transformers\UserTransformer;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $users;


    /**
     * UserController constructor.
     * @param UserRepositoryInterface $users
     */
    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        return fractal()->collection($this->users->getAll())->transformWith(new UserTransformer)->toArray();
    }
}
