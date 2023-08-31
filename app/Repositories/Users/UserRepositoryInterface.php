<?php


namespace App\Repositories\Users;


use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param $searchText
     * @return mixed
     */
    public function searchUser($searchText);
}
