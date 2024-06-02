<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $names = explode(' ',$this->name);
        $firstName = $names[0] ?? '';
        $lastName = $names[1] ?? '';
        $resource = [
            "id" => $this->id,
            "name" => $this->name,
            "first_name" => $firstName,
            "last_name" => $lastName,
            "created_at" => $this->created_at,
        ];

        if($this->hasPostDetails) {
            $resource['posts_count'] = $this->posts_count ?? 0;
            $resource['comments_count'] = $this->comments_count ?? 0;
            $resource['replies_count'] = $this->replies_count ?? 0;
            $resource['votes_count'] = $this->votes_count ?? 0;
        }
        if($this->hasPersonalData) {
            $resource['email'] = $this->email;
        }

        return $resource;
    }
}
