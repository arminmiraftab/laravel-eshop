<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Http\Requests\commentRequest;
use App\Http\Resources\CommentServisResource;
use App\Repository\CommentRepository\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\commentsmol;
use Illuminate\Support\Facades\URL;

class comments extends Controller
{
    /**
     * @var CommentRepositoryInterface
     */
    protected $Comment;

    public function __construct( CommentRepositoryInterface $Comment)
    {
        $this->Comment = $Comment;
    }
    public function savecomm(commentRequest $request,$Product_id){
        if(Auth::check())
         {$vlaue=$this->Comment->store($request,$Product_id);
        if ($vlaue)
            return redirect()->back()->with('message', trans('Validation.comment.success'));
        abort_if(!$vlaue,404);
         } else{
        session::put('detal','product/product-details/'.$Product_id);
        return Redirect::to('panel_user/login_clint')->send();
        }
    }
    function management_comment(){
        return view('admin.all_comment');
    }
    function fetch_comment(){
        $value=$this->Comment->all();
        abort_if(!$value,404);
        return CommentServisResource::collection($value);
    }
    function rejected_Comments_product(Request $Request){
        $vlaue=$this->Comment->confirm_Comments($Request);
        abort_if(!$vlaue,404);
        return Helper::Result($vlaue);
    }
}