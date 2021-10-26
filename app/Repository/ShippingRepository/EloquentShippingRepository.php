<?php



namespace App\Repository\ShippingRepository;



use App\Helper\Helper;
use App\Http\Controllers\Product;
use App\image;
use App\Menu;
use App\Model\manufactures;
use App\Model\shippings;
use App\products;
//use App\Model\products;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Repository\baseEloquent;


/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14.08.2021
 * Time: 19:15
 */

class EloquentShippingRepository implements ShippingRepositoryInterface
{
    use baseEloquent;

        public function __construct(shippings $model)
    {
    $this->model = $model;
    }
        public function store($request):bool {

            $data=array();
            $customer_id=Auth::id();

            $data['shipping_adderss_map']=$request->adderss;
            $data['shipping_address']=$request->adderss_hand;
            $data['shipping_code_post']=$request->post;
            $data['House_number']=$request->plak;
            $data['shipping_unit']=$request->unit;
            $data['long']=$request->Longitude;
            $data['lat']=$request->Latitude;
            $data['customer_id']=$customer_id;
            $this->model::insertGetId($data);
            session::put('message',' با موفقیت ثبت شد');
            return true;
        }

        public function find($id){
            $find=User::where('id',$id)->first();
            return Helper::Result_exist($find);
        }
        public function find_all(){
            $find=shippings::where('customer_id',Auth::id())->get();
            return Helper::Result_exist($find);
        }
        public function delete($id):bool
    {
        $delete=$this->model::where('shipping_id',$id)->delete();
        return Helper::Result_bool($delete);
    }




}