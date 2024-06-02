<?php


namespace App\Services\Users;


use App\Services\BaseServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface UserServiceInterface extends BaseServiceInterface
{
    /**
     * @param $searchText
     * @return AnonymousResourceCollection
     */
    public function searchUser($searchText);

    /**
     * @param $userId
     * @return JsonResponse
     */
    public function getUserDetails($userId);

    /**
     * @param $userId
     * @param $section
     * @param $paginationParams
     * @return mixed
     */
    public function getUserPostsDetails($userId, $section, $paginationParams);
}
