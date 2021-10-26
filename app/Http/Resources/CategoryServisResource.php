<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryServisResource extends JsonResource
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
            'category_description'=> $this->category_description,
            'category_id'=> $this->category_id,
            'category_name'=> $this->category_name,
            'category_status'=> $this->category_status,

        ];
    }
}
