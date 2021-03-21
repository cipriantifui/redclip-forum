<?php

namespace App\Services\PostCommentLike;


use App\Repositories\PostCommentLike\PostCommentLikeRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class PostCommentLikeService extends BaseService implements PostCommentLikeServiceInterface
{
    /**
     * TopicService constructor.
     * @param PostCommentLikeRepositoryInterface $repository
     */
    public function __construct(PostCommentLikeRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Store comment like
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeLike($request)
    {
        $userId = Auth::check() ? Auth::user()->id : null;
        $userVote = $this->checkUserLikeComment($request->get('comment_id'), $userId, $request->get('uid'));
        if ($userVote === false) {
            $this->repository->store([
                'comment_id' => $request->get('comment_id'),
                'user_id' => $userId,
                'uid' => $request->get('uid'),
            ]);
        }

        return $this->item(['success' => true, 'voteUp' => $userVote === false], 201);
    }

    /**
     * This function check if user like this comment
     * @param $commentId
     * @param $userId
     * @param $uid
     * @return bool
     */
    private function checkUserLikeComment($commentId, $userId, $uid)
    {
        if (Auth::check()) {
            $dataFilter = [
                'columns' => ['comment_id', 'user_id'],
                'operations' => ['=', '='],
                'values' => [$commentId, $userId]
            ];
        } else {
            $dataFilter = [
                'columns' => ['comment_id', 'uid'],
                'operations' => ['=', '='],
                'values' => [$commentId, $uid]
            ];
        }

        try {
            $postVote = $this->repository->findByColumns($dataFilter['columns'], $dataFilter['operations'], $dataFilter['values']);
            $postVote->delete();

            return true;
        } catch (\Exception $exception) {
        }

        return false;
    }
}
