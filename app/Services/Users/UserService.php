<?php


namespace App\Services\Users;


use App\Repositories\Users\UserRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class UserService extends BaseService implements UserServiceInterface
{
    /**
     * UserService constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

}
