<?php

namespace App\Services\Topic;


use App\Http\Resources\TopicResource;
use App\Services\BaseServiceInterface;

interface TopicServiceInterface extends BaseServiceInterface
{
    public function getTopics(int $perPage, int $page, array $orderByColumns);
    public function getTopic(int $id): TopicResource;
}
