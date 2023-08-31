<?php


namespace App\Services\Users;


use App\Http\Resources\UserResource;
use App\Repositories\Users\UserRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
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

    /**
     * @param $searchText
     * @return AnonymousResourceCollection
     */
    public function searchUser($searchText)
    {
        return UserResource::collection($this->repository->searchUser($searchText));
    }

}
