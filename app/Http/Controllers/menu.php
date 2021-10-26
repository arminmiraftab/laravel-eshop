<?php

namespace App\Http\Controllers;

use App\category_maunfactur;
use App\categorys;
use App\Http\Requests\SaveMenuRequest;
use App\Http\Requests\SaveSubMenuRequest;
use App\manufactures;
use App\products;
use App\Repository\MenuRepository\MenuRtepositoryInterface;
use App\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class menu extends Controller
{
    /**
     * @var MenuRtepositoryInterface
     */
    private $Menu;

    public function __construct(MenuRtepositoryInterface $Menu)
    {
        $this->Menu = $Menu;
    }
    public function add_menu()
    {
        $all_table_category=$this->Menu->show();
        abort_if(!$all_table_category,404);

        return view('admin.add_menu_admin',compact('all_table_category'));

    }
    public function sevemenu(SaveMenuRequest $request)
    {
       $this->Menu->store($request);

         return redirect::to('admin/add_menu');
    }
    public function seveSUBmenu(SaveSubMenuRequest $request)
    {
        $this->Menu->store_sub_menus($request);
        return redirect::to('admin/add_menu');
    }
    public function show_men()
    {        $menus=DB::table('menus')->get();

//        $db_info=manufactures::find(2);
//        $categorys=$this->Category->show();
        $return=category_maunfactur::where('manufacture_id',2)->select('category_id')->pluck('category_id');
        $exp= Arr::flatten($return);//       return $return[1]->category_id;
        $brand=categorys::whereNotIn('category_id',$exp )->select('category_name','category_id')->get();


//        return view('admin.EDIT_manufacture',compact('categorys','db_info','brand'));
        return view('admin.show_menu_admin',compact('brand','menus'));

    }
    public function Fetch_menu(Request $request)
    {
        $userData['data']=products::all();
        echo json_encode($userData);
        exit;
    }

}
