<?php



namespace App\Repository\MenuRepository;



use App\Helper\Helper;
use App\Http\Controllers\Product;
use App\image;
use App\Menu;
use App\Model\manufactures;
use App\products;
//use App\Model\products;
use App\SubMenu;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Repository\baseEloquent;


/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14.08.2021
 * Time: 19:15
 */

class EloquentMenurRepository implements MenuRtepositoryInterface
{
    use baseEloquent;

        public function __construct(Menu $model)
    {
    $this->model = $model;
    }
        public function show(){
         $product=$this->model::with(['submenu'])->get();
            return Helper::Result_exist($product);
        }
        public function test(){return 'ok';
    }
        public function store($request):bool {
            $data=array();
            $data['name']=$request->namemen;
            $data['url']=$request->linkmen;
            $product= $this->model::insert($data);
            return Helper::Result_bool($product);
        }
        public function find($id){
            $find=$this->model::where('id',$id)->first();
            return Helper::Result_exist($find);
        }
        public function store_sub_menus($request){
            $data=array();
            $data['name']=$request->name_sub;
            $data['link']=$request->link_sub;
            $data['menu_id']=$request->category_id;
        session::put('messagea',' با موفقیت ثبت شد');
            $menus= SubMenu::insert($data);
            return Helper::Result_bool($menus);

        }






}