<?php


namespace App\Repositories\Topic;


use App\Repositories\BaseRepositoryInterface;

interface TopicRepositoryInterface extends BaseRepositoryInterface
{
    public function getTopics(int $perPage, int $page, array $orderByColumns);
    public function getTopic(int $id);
}
