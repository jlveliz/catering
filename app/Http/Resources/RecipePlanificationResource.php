<?php

namespace Catering\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipePlanificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
