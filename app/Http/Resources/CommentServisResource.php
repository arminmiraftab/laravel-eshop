<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentServisResource extends JsonResource
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

//
//        $alt='123';
//        $image=$this->comment_photo->imageable_path;
//        if($this->comment_photo->imageable_path==null)
//            $image= 'image/none-600x600.png';
////
//        return [
//            'id'=>$this->id,
//            'content'=>$this->content,
//            'title'=>$this->title,
//            'status'=>$this->status,
//            'prodoct'=>[
//                'Product_name'=>$this->prodoct->Product_name
//            ],
//            'user'=>[
//                'name'=>$this->user->name
//            ],
//            'comment_photo'=>[
//////                'imageable_alt'=>$this->comment_photo->imageable_alt,
////                'imageable_alt'=>$alt,
//                'imageable_path'=>$image
//            ],
////
//        ];
    }
}
