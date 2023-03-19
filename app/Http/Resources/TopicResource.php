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
            "created_at" => $this->created_at,
            "posts_count" => $this->posts_count ?? 0,
            'posts' => PostResource::collection($this->whenLoaded('posts'))
        ];
    }
}
