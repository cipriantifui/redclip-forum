<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            "topic" => new TopicResource($this->whenLoaded('topic')),
            "user" => new UserResource($this->whenLoaded('user')),
            "comments" => CommentResource::collection($this->whenLoaded('comments')),
            "uid" => $this->uid,
            "type" => $this->type,
            "content" => $this->content,
            "comments_count" => $this->comments_count ?? 0,
            "votes_count" => $this->votes_count ?? 0,
            "url_image" => $this->url_image,
            "url_video" => $this->url_video,
            "date_ago" => $this->created_at ? $this->created_at->diffForHumans() : null,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
