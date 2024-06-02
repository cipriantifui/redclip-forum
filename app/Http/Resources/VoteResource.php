<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoteResource extends JsonResource
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
            "user_id" => $this->user_id,
            "user" => new UserResource($this->whenLoaded('user')),
            "uid" => $this->uid,
            "votable" => $this->votable,
            "votable_id" => $this->votable_id,
            "votable_type" => $this->votable_type,
            "date_ago" => $this->created_at ? $this->created_at->diffForHumans() : null,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
