<?php

namespace Catering\Http\Resources;

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
        return [
            'id' => $this->id,
            'username' => $this->username,
            'fullname' => $this->name. ' '. $this->lastname,
            'email' => $this->email,
            'state' => $this->state,
            'role' => $this->role,
            'created_at' => $this->created_at,
            'udpated_at' => $this->updated_at
        ];
    }
}
