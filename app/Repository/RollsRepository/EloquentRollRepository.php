<?php



namespace App\Repository\RollsRepository;



use App\Helper\Helper;
use App\Http\Controllers\Product;
use App\image;
use App\Menu;
use App\Model\manufactures;
use App\products;
//use App\Model\products;
use App\role;
use App\sliders;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Repository\baseEloquent;


/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14.08.2021
 * Time: 19:15
 */

class EloquentRollRepository implements RollRepositoryInterface
{
//    use baseEloquent;
//    public function all(){
//
//    }
//    public function find(){
//
//    }

//        protected  $status='Product_status';
//        protected $model;
    /**
     * @var SliderRepositoryInterface
     */

    protected  $status='slider_status';
    /**
     * @var sliders
     */
    private $model;

    public function __construct(role $model)
{
    $this->model = $model;
}


        public function show(){
            $roll=$this->model::select('id','name')->get();
            return Helper::Result_exist($roll);
        }
        public function all(){
            $roll=$this->model::select('id','name')->get();
            return Helper::Result_exist($roll);
        }
        public function find($id){
            $roll=$this->model::where('id',$id)->get();
            return Helper::Result_exist($roll);
        }




}