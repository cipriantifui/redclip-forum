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
        return [
            "id" => $this->id,
            "name" => $this->name,
            "first_name" => $firstName,
            "last_name" => $lastName,
            "created_at" => $this->created_at,
        ];
    }
}
