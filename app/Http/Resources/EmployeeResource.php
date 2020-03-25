<?php

namespace Catering\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       
        $employee = parent::toArray($request);
        $employee['workplace'] = $this->workplace;
        $employee['creator'] = $this->creator;
        return $employee;
    }
}
