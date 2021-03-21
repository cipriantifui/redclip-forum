<?php

namespace App\Services\PostVote;


use App\Exceptions\VoteException;
use App\Repositories\PostVote\PostVoteRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class PostVoteService extends BaseService implements PostVoteServiceInterface
{
    /**
     * TopicService constructor.
     * @param PostVoteRepositoryInterface $repository
     */
    public function __construct(PostVoteRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Store comment vote
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePostVote($request)
    {
        $userId = Auth::check() ? Auth::user()->id : null;
        $userVote = $this->checkUserVotedPost($request->get('post_id'), $userId, $request->get('uid'));
        if ($userVote === false) {
            $this->repository->store([
                'post_id' => $request->get('post_id'),
                'user_id' => $userId,
                'uid' => $request->get('uid'),
            ]);
        }

        return $this->item(['success' => true, 'voteUp' => $userVote === false], 201);
    }

    /**
     * This function check if user voted this post
     * @param $postId
     * @param $userId
     * @param $uid
     * @return bool
     */
    private function checkUserVotedPost($postId, $userId, $uid)
    {
        if (Auth::check()) {
            $dataFilter = [
                'columns' => ['post_id', 'user_id'],
                'operations' => ['=', '='],
                'values' => [$postId, $userId]
            ];
        } else {
            $dataFilter = [
                'columns' => ['post_id', 'uid'],
                'operations' => ['=', '='],
                'values' => [$postId, $uid]
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
