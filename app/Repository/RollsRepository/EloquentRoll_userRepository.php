<?php



namespace App\Repository\RollsRepository;



use App\Helper\Helper;
use App\Http\Controllers\Product;
use App\image;
use App\Menu;
use App\Model\manufactures;
use App\products;
//use App\Model\products;
use App\role_user;
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

class EloquentRoll_userRepository implements Roll_UserRepositoryInterface
{
    /**
     * @var SliderRepositoryInterface
     */

         protected  $status='slider_status';
        /**
          * @var sliders
         */
         private $model;

         public function __construct(role_user $model){
        $this->model = $model;
         }

        public function exists($user_id,$role_id){
            $exists = $this->model::where('role_id', $role_id)->where('user_id', $user_id)->exists();
            return Helper::Result_exist($exists);

        }
        public function store($Request){
             $flight = new role_user();
             $flight->role_id = $Request->roll;
             $flight->user_id = $Request->user;
             $role= $flight->save();
             return Helper::Result_bool($role);
        }





}