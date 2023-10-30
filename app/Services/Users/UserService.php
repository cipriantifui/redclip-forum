<?php


namespace App\Services\Users;


use App\Http\Resources\UserResource;
use App\Repositories\Users\UserRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

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

    /**
     * @param $userId
     * @return JsonResponse
     */
    public function getUserPostDetails($userId)
    {
        $user = $this->repository->getUserPostDetails($userId);
        $user->hasPostDetails = true;
        return $this->item(new UserResource($user));
    }

    public function getLiveStatus($userId)
    {
        $user = $this->repository->show($userId);

        // check online status
        $isOnline = false;
        $status = 'Offline';
        if (Cache::has('user-is-online-' . $user->id)) {
            $status = 'Online';
            $isOnline = true;
        }

        // check last seen
        $lastSeen = "No data";
        $lastSeenAt = "No data";
        if ($user->last_seen_at != null) {
            $lastSeen = "Joined " . Carbon::parse($user->last_seen_at)->diffForHumans();
            $lastSeenAt = Carbon::parse($user->last_seen_at);
        }

        // response
        return $this->itemResponse([
            'status' => $status,
            'isOnline' => $isOnline,
            'lastSeen' => $lastSeen,
            'lastSeenAt' => $lastSeenAt,
            ]);
    }
}
