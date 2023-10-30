<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            "id" => $this->id,
            "content" => $this->content,
            "is_published" => $this->is_published,
            "uid" => $this->uid,
            "user" => new UserResource($this->whenLoaded('user')),
            "post" => new PostResource($this->whenLoaded('post')),
            "likes" => $this->votes,
            "likes_count" => $this->votes_count ?? 0,
            "replies" => CommentResource::collection($this->whenLoaded('replies')),
            "replies_count" => $this->replies_count ?? 0,
            "date_ago" => $this->created_at ? $this->created_at->diffForHumans() : null,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
