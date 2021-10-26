<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecommendRequest extends JsonResource
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
            'photo'=>$this->photo,
            'Product_id'=>$this->Product_id,
            'Product_name'=>$this->Product_name,
            'Product_price'=>$this->Product_price,
        ];
    }
}
