<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class rollResource extends JsonResource
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
          'National_Code'=>$this->National_Code,
          'id'=>$this->id ,
          'email'=>$this->email,
          'last_name'=>$this->last_name,
          'name'=>$this->name,
          'phone_number'=>$this->phone_number,
          'roll'=>$this->roll,

        ];
    }
}
