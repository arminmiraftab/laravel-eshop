<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class brandServisResource extends JsonResource
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
            'manufacture_description'=>$this->manufacture_description,
            'manufacture_id'=>$this->manufacture_id,
            'manufacture_name'=>$this->manufacture_name,
            'manufacture_status'=>$this->manufacture_status,
        ];
    }
}
