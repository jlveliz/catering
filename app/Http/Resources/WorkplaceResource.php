<?php

namespace Catering\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkplaceResource extends JsonResource
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
            'code' => $this->code,
            'name'=> $this->name,
            'num_employees' => $this->employees()->count(),
            'address' => $this->address,
        ];
    }
}
