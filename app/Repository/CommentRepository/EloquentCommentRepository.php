<?php



namespace App\Repository\CommentRepository;


use App\colormodel;
use App\commentsmol;
use App\Helper\Helper;
use App\Model\categorys;
use App\Repository\baseEloquent;
use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14.08.2021
 * Time: 19:15
 */

class EloquentCommentRepository implements CommentRepositoryInterface
{
    use baseEloquent;

    /**
     * @var categorys
     */
    protected $model;
    protected  $status='category_status';


    public function __construct(commentsmol $model)
    {
        $this->model = $model;
    }
    public function all(){
        $comments=$this->model::with(['comment_photo','prodoct','user'])->get();

        return Helper::Result_exist($comments);
    }
    public function store($request,$id){
        $customer_id=Auth::id();
        $data=array();
            $data['title']=$request->cate;
            $data['content']=$request->tex;
            $data['Product_id']=$id;
            $data['customer_id']=$customer_id;
           $store= commentsmol::insert($data);
        return Helper::Result_bool($store);
    }
    public function find($id){
       return $this->model::find($id)->first();
    }
    public function comment_product($id){
        $comment= $this->model::with(['prodoct','user'])
           ->Active()
            ->OfIdProduct($id)
            ->limit(5)->get();
        return Helper::Result_exist($comment);
    }
    function confirm_Comments ($Request):bool
    {
        $flight =$this->model::find($Request->id);
            $flight->status = $Request->val;
        $store= $flight->save();
        return Helper::Result_bool($store);
    }


}