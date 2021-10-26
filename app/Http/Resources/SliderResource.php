<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'category_slider'=>$this->detal_slider,
            'detal_slider'=>$this->detal_slider,
            'slider_image'=>$this->slider_image,
            'slider_status'=>$this->slider_status,
            'sub_category_slider'=>$this->sub_category_slider,
            'submit_link'=>$this->submit_link,
            'submit_slider'=>$this->submit_slider,
            'slider_id'=>$this->slider_id,
        ];
    }
}
