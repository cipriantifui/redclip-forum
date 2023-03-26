<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            'posts' => PostResource::collection($this->whenLoaded('posts')),
            "posts_count" => $this->posts_count ?? 0,
            "created_at" => $this->created_at,
            "date_ago" => $this->created_at->diffForHumans()
        ];
    }
}
