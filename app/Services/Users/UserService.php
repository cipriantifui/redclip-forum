<?php


namespace App\Services\Users;


use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\PostComment\PostCommentRepositoryInterface;
use App\Repositories\PostCommentLike\PostCommentLikeRepositoryInterface;
use App\Repositories\PostVote\PostVoteRepositoryInterface;
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
     * @var PostVoteRepositoryInterface
     */
    private $postVoteRepository;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $repository
     * @param PostRepositoryInterface $postRepository
     * @param PostCommentRepositoryInterface $postCommentRepository
     * @param PostCommentLikeRepositoryInterface $postCommentLikeRepository
     * @param PostVoteRepositoryInterface $postVoteRepository
     */
    public function __construct(UserRepositoryInterface $repository,
                                PostRepositoryInterface $postRepository,
                                PostCommentRepositoryInterface $postCommentRepository,
                                PostCommentLikeRepositoryInterface $postCommentLikeRepository,
                                PostVoteRepositoryInterface $postVoteRepository)
    {
        parent::__construct($repository);
        $this->postRepository = $postRepository;
        $this->postCommentRepository = $postCommentRepository;
        $this->postCommentLikeRepository = $postCommentLikeRepository;
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
     * @return JsonResponse
     */
    public function getUserPostsDetails($userId, $section)
    {
        if($section === 'posts') {
            $posts = $this->postRepository->getUserPosts(10, 1, $userId);
            return PostResource::collection($posts);
        }
        if($section === 'comments') {
            $comments = $this->postCommentRepository->getUserComments(10, 1, $userId);
            return CommentResource::collection($comments);
        }
        if($section === 'likes') {
            $commentLikes = $this->postCommentLikeRepository->getUserLikes(10, 1, $userId);
            $postLikes = $this->postVoteRepository->getUserLikes(10, 1, $userId);
//            dd($postLikes, $commentLikes);
            $posts = collect();
            $posts = $posts->merge($commentLikes);
            $posts = $posts->merge($postLikes);
            dd($posts);
            return $this->collection($likes);
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
