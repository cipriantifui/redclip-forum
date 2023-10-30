<?php

namespace App\Services\PostVote;


use App\Exceptions\VoteException;
use App\Repositories\PostVote\VoteRepositoryInterface;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class VoteService extends BaseService implements VoteServiceInterface
{
    /**
     * TopicService constructor.
     * @param VoteRepositoryInterface $repository
     */
    public function __construct(VoteRepositoryInterface $repository)
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
        $userVote = $this->checkUserVotedPost($request->get('votable_id'), $request->get('votable_type'), $userId, $request->get('uid'));
        if ($userVote === false) {
            $this->repository->store([
                'votable_id' => $request->get('votable_id'),
                'votable_type' => $request->get('votable_type'),
                'user_id' => $userId,
                'uid' => $request->get('uid'),
            ]);
        }

        return $this->item(['success' => true, 'voteUp' => $userVote === false], 201);
    }

    /**
     * This function check if user voted this post
     * @param $votableId
     * @param $votableType
     * @param $userId
     * @param $uid
     * @return bool
     */
    private function checkUserVotedPost($votableId, $votableType, $userId, $uid)
    {
        if (Auth::check()) {
            $dataFilter = [
                'columns' => ['votable_id', 'votable_type', 'user_id'],
                'operations' => ['=', '=', '='],
                'values' => [$votableId, $votableType, $userId]
            ];
        } else {
            $dataFilter = [
                'columns' => ['votable_id', 'uid'],
                'operations' => ['=', '=', '='],
                'values' => [$votableId, $votableType, $uid]
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
