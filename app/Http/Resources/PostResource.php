<?php

namespace App\Http\Resources;

use App\Models\Topic;
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
//        return parent::toArray($request);
        return [
            "id" => $this->id,
            "title" => $this->title,
            "topic" => new TopicResource($this->whenLoaded('topic')),
            "user" => new UserResource($this->whenLoaded('user')),
            "uid" => $this->uid,
            "content" => $this->content,
            "url_image" => $this->url_image,
            "url_video" => $this->url_video,
            "created_at" => $this->created_at,
        ];
    }
}
