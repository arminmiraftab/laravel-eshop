<?php

namespace App\Http\Controllers;

use App\admins;
use App\categorys;
use App\customermol;
//use Auth;

use App\Helper\Helper;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\IdRequest;
use App\Http\Requests\RuleRequest;
use App\Http\Requests\user_rule;
use App\Http\Resources\Roll_adminResource;
use App\Http\Resources\rollResource;
use App\model\View;
use App\orders;
use App\products;
use App\Repository\OrderRtepository\OrderRepositoryInterface;
use App\Repository\ProductsRtepository\ProductsRtepositoryInterface;
use App\Repository\RollsRepository\Roll_UserRepositoryInterface;
use App\Repository\RollsRepository\RollRepositoryInterface;
use App\Repository\UserRepository\AdminRepository\AdminRepositoryInterface;
use App\Repository\UserRepository\UserRtepositoryInterface;
use App\Repository\ViewRepository\ViewRepositoryInterface;
use App\role;
use App\role_user;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class superadmin extends Controller
{


    /**
     * @var UserRtepositoryInterface
     */
    protected $User;
    /**
     * @var ProductsRtepositoryInterface
     */
    protected $Product;
    /**
     * @var OrderRepositoryInterface
     */
    protected $Order;
    /**
     * @var Roll_UserRepositoryInterface
     */
    protected $Roll_User;
    /**
     * @var RollRepositoryInterface
     */
    protected $Roll;
    /**
     * @var ViewRepositoryInterface
     */
    protected $View;
    /**
     * @var AdminRepositoryInterface
     */
    protected $Admin;

    public function __construct(
        UserRtepositoryInterface $User,
        ProductsRtepositoryInterface $Product,
        OrderRepositoryInterface $Order,
        Roll_UserRepositoryInterface $Roll_User,
        RollRepositoryInterface $Roll,
        AdminRepositoryInterface $Admin,
        ViewRepositoryInterface $View)
    {
        $this->User = $User;
        $this->Product = $Product;
        $this->Order = $Order;
        $this->Roll_User = $Roll_User;
        $this->Roll = $Roll;
        $this->View = $View;
        $this->Admin = $Admin;
    }

    public function index()
    {
        $Chromes = $this->View->Percentage_browser('Chrome');
        $Firefoxs = $this->View->Percentage_browser('Firefox');
        $Safaries = $this->View->Percentage_browser('Safari');
        $Safaries = $this->View->Percentage_browser('Edge');
        $Operaes = $this->View->Percentage_browser('Opera');
        $customer = $this->User->count();
        $products = $show_Product_table = $this->Product->count();
        $order = $this->Order->count();

        return view('admin.dashbord', compact('customer',
            'products', 'order', 'Chromes', 'Safaries', 'Firefoxs', 'Operaes'
        ));
    }

    public function logout_admin()
    {
        $this->away_login();
        Auth('admin')->logout();
        return redirect('/');
    }

    public function logout(Request $request)
    {
        $this->away_login();
        Auth::logout();
        return redirect('/');
    }

    //away checking login admin
    public function away_login()
    {
        $away = Session::get('true_away');
        if ($away)
            session::put('true_away', null);
    }

    public function add_access_roll()
    {
        $user = $this->User->user_select();
        $admin = admins::all();
        $roll = $this->Roll->show();
        return view('admin.add_access_roll', [
            "admins" => $admin,
            "user" => $user,
            "roll" => $roll
        ]);
    }

    protected function validator($data)
    {
        $messages = [
            'role_id.numeric' => 'داده اشتباه وارد شد',
            'user_id.numeric' => 'داده اشتباه وارد شد',
            'role_id.max' => 'کارکتر بیشتر از حد وارد شد',
            'user_id.max' => 'کارکتر بیشتر از حد وارد شد',

        ];
        return Validator::make($data, [
            'role_id' => ['numeric', 'max:255',
                Rule::unique('users')
            ],
            'user' => ['numeric', 'max:255',
                Rule::unique('users','id')],
        ], $messages);
    }

    public function save_access_roll(Request $Request)
    {
        $x = role::find($Request->roll);
        if ($x->name=='user'){

            $validation = $this->validator($Request->all());
            if ($validation->fails()) {
                return response()->json(['error' => $validation->errors()]);
            } else {
              if ($this->Admin->find($Request->user)->email) {
                  $User=$this->Admin->find($Request->user)->email;


                $Users = User::where('email',$User)->exists();
//                    $this->User->find($Request->user);
//return 'ok';
//                $existss = $this->User->exists($Request->user, $Request->roll);
//                $existss=
////                $exists=1;
                if ( $Users ) {
                    return response()->json(['error' =>trans('Validation.user.unique')]);

                }
               else{
                          return 'ok';

//
//                    $User = $this->Admin->find($Request->user);
//                    $exist =  $this->User->Roll_store($User,$Request->roll);
//                    $save = Helper::Result($exist);
//                    return $save;
                }}
            }
        }else{
            $exists = $this->Admin->exists($Request->user, $Request->roll);
            if (!$exists) {
                $User = $this->User->find($Request->user);
                $exist =  $this->Admin->Roll_store($User,$Request->roll);
                $save = Helper::Result($exist);
                return $save;
            }
           else {
               return response()->json(['error' => trans('Validation.user.unique')]);
           }
        }
    }

    public function save_registera(Request $request)
    {
        $messages = [

            'name.required' => trans('Validation.user.name.required'),
            'name.max' => trans('Validation.user.name.max'),
            'last_name.max' => trans('Validation.user.last_name.max'),
            'last_name.required' => trans('Validation.user.last_name.required'),
            'email.max' => trans('Validation.user.email.max'),
            'email.required' => trans('Validation.user.email.required'),
            'email.email' => trans('Validation.user.email.email'),
            'email.unique' => trans('Validation.user.email.unique'),
            'password.required' => trans('Validation.user.password.required'),
            'password.max' => trans('Validation.user.password.max'),
            'password.min' => trans('Validation.user.password.min'),
            'password.confirmed' => trans('Validation.user.password.confirmed'),


        ];
        $x = role::find($request->roll);
        if ($x->name == 'user') {

            $validation = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:2|confirmed',
            ], $messages);
        }else{
            $validation = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
//            'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:admins',
                'password' => 'required|string|min:2|confirmed',
            ], $messages);
        }

            if ($validation->fails()) {

                return response()->json(['error' => $validation->errors()]);

        } else {
//return $request->all();
            (new RegisterController)->registers_admin($request->all(),$x->name);
            return response()->json(['success' => 'با موفقیت انجام شد']);
        }

//        }

    }

    function show_details_rule()
    {
        return view('admin.all_access_roll');
    }

    function show_ADMIN_details_rule()
    {
        return view('admin.all_access_admin_roll');
    }

    function rule_fetch()
    {
        return rollResource::collection($this->User->Roll_Fetch());
    }

    function rule_admin_fetch()
    {
        return Roll_adminResource::collection($this->User->Roll_admin_Fetch());
    }

    function delet_rule(IdRequest $Request)
    {
        $vlaue = $this->User->delete($Request->id);
        $save = Helper::Result($vlaue);
        return $save;
    }
    function delet_rule_admin(IdRequest $Request)
        {
            $vlaue = $this->User->delete_admin($Request->id);
            $save = Helper::Result($vlaue);
            return $save;
        }

    function Edite_rule_show($id)
    {
        $db_user = $this->User->Roll_Edite($id);
        $db_rule = $this->Roll->show();
        return view('admin.Edit_access_rule', compact('db_user', 'db_rule'));
    }
    function Edite_rule_admin_show($id)
    {
//        $db_user = $this->User->Roll_Edite($id);
        $db_user = $this->Admin->Roll_Edite($id);
        $db_rule = $this->Roll->show();
        return view('admin.Edit_access_roll_admin', compact('db_user', 'db_rule'));
    }

    function analyze_sales_Month()
    {

        $Month = $this->Order->analyze_sales_Month();
        return response()->json($Month);
    }

    function analyze_sales_Day()
    {
        $Day = $this->Order->analyze_sales_Day();
        return response()->json($Day);
    }

    function analyze_sales_Year()
    {
        $Year = DB::table('order')
            ->where('payment_id', '!=', null)
            ->select(DB::raw('Year(created_at) as time'), DB::raw('sum(order_total) as total'))
            ->groupBy(DB::raw('Year(created_at)'))
            ->get();
        return response()->json($Year);
    }

    function analyze_view_platform()
    {
        $Windows = $this->View->Percentage_platform('Windows');
        $Android = $this->View->Percentage_platform('AndroidOS');
        $iOS = $this->View->Percentage_platform('iOS');
        return response()->json([$Windows, $Android, $iOS]);
    }

    function analyze_view_category()
    {
        $categorys = categorys::all();
    }

    function Edite_rule_save(RuleRequest $Request)
    {
        if ($Request->rule_id<=1){
            $result=  $this->User->update_admin($Request->id, $Request);
                    abort_if(!$result, 404);
        }
        else{
//            return $Request->password;
            $User=$this->User->find($Request->id);
            if ($Request->password==null)
                $Request['password']=$User->password;
            $User=$this->User->find($Request->id);
            $this->Admin->Roll_store($Request, $Request->rule_id);
            $this->User->delete($Request->id);

        }

        return redirect::to('/admin/show_rule');
    }
    function Edite_save_User($Request)
    {
    }
    function Edite_rule_save_admin(Request $Request)
        {     $x=$this->Roll->find($Request->rule_id);

        if ($x->name == 'user') {
//            $this->validator_user($Request)->validate();
            $Users=$this->Admin->find($Request->id);
            $Users['last_name']=$Request->last_name;
            if ($Request->password)
            $Users['password']=$Request->password;
             if ($Request->email)
               $Users['email']=$Request->email;
            if ($Request->name)
            $Users['name']=$Request->name;
            if ($Request->name)
             $Users['name']=$Request->name;

            $this->User->Roll_store($Users);
            $this->Admin->delete($Request->id);
            return redirect::to('/admin/show_rule_ADMIN');


        }else{
            $this->Admin->update($Request->id, $Request);
            return redirect::to('/admin/show_rule_ADMIN');
        }

    }
}
