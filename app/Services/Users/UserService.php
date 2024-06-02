<?php


namespace App\Services\Users;


use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\VoteResource;
use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\PostComment\PostCommentRepositoryInterface;
use App\Repositories\PostCommentLike\PostCommentLikeRepositoryInterface;
use App\Repositories\PostVote\VoteRepositoryInterface;
use App\Repositories\Users\UserRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class UserService extends BaseService implements UserServiceInterface
{
    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;
    /**
     * @var PostCommentRepositoryInterface
     */
    private $postCommentRepository;
    /**
     * @var PostCommentLikeRepositoryInterface
     */
    private $postCommentLikeRepository;
    /**
     * @var VoteRepositoryInterface
     */
    private $postVoteRepository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $repository
     * @param PostRepositoryInterface $postRepository
     * @param PostCommentRepositoryInterface $postCommentRepository
     * @param VoteRepositoryInterface $postVoteRepository
     */
    public function __construct(UserRepositoryInterface            $repository,
                                PostRepositoryInterface            $postRepository,
                                PostCommentRepositoryInterface     $postCommentRepository,
                                VoteRepositoryInterface            $postVoteRepository)
    {
        parent::__construct($repository);
        $this->postRepository = $postRepository;
        $this->postCommentRepository = $postCommentRepository;
        $this->postVoteRepository = $postVoteRepository;
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
    public function getUserDetails($userId)
    {
        $user = $this->repository->getUserDetails($userId);
        $user->hasPostDetails = true;
        return $this->item(new UserResource($user));
    }

    /**
     * @param $userId
     * @param $section
     * @param $paginationParams
     * @return JsonResponse
     */
    public function getUserPostsDetails($userId, $section, $paginationParams)
    {
        if($section === 'posts') {
            $posts = $this->postRepository->getUserPosts($paginationParams['perPage'], $paginationParams['page'], $userId);
            return PostResource::collection($posts);
        }
        if($section === 'comments') {
            $comments = $this->postCommentRepository->getUserComments($paginationParams['perPage'], $paginationParams['page'], $userId);
            return CommentResource::collection($comments);
        }
        if($section === 'likes') {
            $votes = $this->postVoteRepository->getUserLikes($paginationParams['perPage'], $paginationParams['page'], $userId);
            return VoteResource::collection($votes);
        }

        return $this->collection([]);
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
