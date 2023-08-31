<?php


namespace App\Services\Users;


use App\Services\BaseServiceInterface;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface UserServiceInterface extends BaseServiceInterface
{
    /**
     * @param $searchText
     * @return AnonymousResourceCollection
     */
    public function searchUser($searchText);
}
