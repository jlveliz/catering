<?php

namespace Catering\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $customer = parent::toArray($request);
        $customer['creator'] = $this->creator;
        $customer['id_type'] = $this->idType;
        return $customer;
    }
}
