<?php

namespace App\Http\Controllers;

use App\category_maunfactur;
use App\categorys;
use App\commentsmol;
use App\Http\Middleware\isadmin;
use App\Http\Resources\brandServisResource;
use App\Http\Resources\RecommendRequest;
use App\image;
use App\manufactures;
use App\Menu;
//use App\Model\sliders;
use App\Model\payments;
use App\Notifications\InvoicePaidNotification;
use App\order_details;
use App\orders;
use App\product_filter\brand_filter\brand_product;
use App\products;
use App\Repository\MenuRepository\MenuRtepositoryInterface;
use App\Repository\ProductsRtepository\ProductsRtepositoryInterface;
use App\Repository\UserRepository\AdminRepository\AdminRepositoryInterface;
use App\Repository\UserRepository\UserRtepositoryInterface;
use App\role;
use App\shippings;
use App\sliders;
use App\SubMenu;
use App\User;
use App\View;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Input;
//use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\UrlGenerator;
use App\admins;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Facades\Agent;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

//use Jenssegers\Agent\Agent;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

session_start();

class admin extends Controller
{
    /**
     * @var MenuRtepositoryInterface
     */
    private $Menu;
    /**
     * @var UserRtepositoryInterface
     */
    private $User;
    protected $product;
    /**
     * @var MenuRtepositoryInterface
     */
    private $Manufacture;
    /**
     * @var AdminRepositoryInterface
     */
    private $Admin;

    /**
     * @var ProductRtepositoryInterface
     */

    public function __construct(
        MenuRtepositoryInterface $Menu,
        ProductsRtepositoryInterface $product,
        UserRtepositoryInterface $User,
        AdminRepositoryInterface $Admin,
        MenuRtepositoryInterface $Manufacture)
    {

        $this->Menu = $Menu;
        $this->product = $product;
        $this->User = $User;
        $this->Manufacture = $Manufacture;
        $this->Admin = $Admin;
    }

//    function log(){
//        return view('admin_login');
//    }

    /**
     * @param Request $request
     */
    public function dashboard()
    {

        session::put('true_away', 'ok');
        return redirect::to('admin/Dashboard');

    }

    public function twdt()
    {
        $user = User::find(1);
//        if(Gate::denise('login-in')){
//          dd('no accses ');
//        }

//       return view('test.test',['user'=>User::all()]);
        if (Gate::allows('is-admin'))
            return view('test.test', compact('user'));
        dd('you need accses admin');
    }

    public function admin()
    {
        $user = User::find(1);

        echo URL::current();

//        session::put('true_away','ok');

        return redirect::to('aaa');


//            return view('test.test',compact('user','url'));
    }

    public function admi2()
    {
        $user = categorys::find(1);
        foreach ($user->brands as $role) {
            echo $role;

        }
    }

    public function logout(Request $request)
    {
        session::put('true_away', null);

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    public function admi(Request $request)
    {
        $name = $request->all();
        $image = $request->file('pimage');

        return response()->json(['success' => 'باموفقیت انجام شد', 'error' => 'انجام نشد لطفا دوباره امتحان کنید ', 'name' => $name, 'image' => $image]);
    }

    function sho()
    {
        $s = manufactures::where('manufacture_id', 1)->first();

        echo $s->manufacture_status;


    }

    function action(Request $request)
    {
        $f = $request->price_Product;
        $validation = Validator::make($request->all(), [
            'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($validation->passes()) {
            $image = $request->file('select_file');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $new_name);
            return response()->json([
                'message' => 'Image Upload Successfully',
                'uploaded_image' => '<img src="/images/' . $new_name . '" class="img-thumbnail" width="300" />',
                'class_name' => 'alert-success',
                'all' => $f
            ]);
        } else {
            return response()->json([
                'message' => $validation->errors()->all(),
                'uploaded_image' => '',
                'class_name' => 'alert-danger'
            ]);
        }
    }

    function tfetch()
    {
        $value = DB::table('manufacture')->orderBy('manufacture_id', 'asc')->get();
        $userData['data'] = $value;

        echo json_encode($userData);
        exit;
//        $students = Student::select('id', 'first_name', 'last_name');
//        return Datatables::of($students)
//            ->addColumn('action', function($student){
//                return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$student->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
//            })
//            ->make(true);
//        return view('test.ts');


    }

    public function tfetch_sho()
    {
        $category_branbd['category_id'] = 1;
        $category_branbd['manufacture_id'] = 1;
        DB::table('category_maunfacturees')->insert($category_branbd);
//                    return view('test.ts');

    }

    function x()
    {
        $j = products::query()->with(['photo', 'brand', 'category']);

        if (\request()->has('act')) {
            $j->whereIn('Product_id', \request()->act);


        }
        return view('test.test', [
            'j' => $j->get()
        ]);


    }

    public function tr()
    {
//
    }

    public function view()
    {
//        $agent = new Agent();
//        return   $agent->browser();
        $data = new view;
        $data->browser = Agent::browser();
        $data->device = Agent::device();
        $data->platform = Agent::platform();
        $data->Path = $_SERVER['REQUEST_URI'];
        $data->save();
    }

    public function sendgmail58()
    {
        $data = array('name' => "Hardik Parsania", "body" => "Gmail from Laravel");

        Mail::send('mail', $data, function ($message) {
            $message->to('miraftab.armin@gmail.com', 'John Doe')
                ->subject('From Laravel With Gmail');
            $message->from('sinasabahi43@gmail.com', ' Jesal Mithani');

        });
//echo 'ok';
        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        } else {
            return response()->json('Yes, You have sent email to GMAIL from LARAVEL 5.8 !!');
        }
    }

    public function notif()

    {
        $date = Carbon::now()->timestamp;
        $order_id = 2;
        $customer_id = Auth::id();
        $show_detal = order_details::with(['order_photo'])
            ->join('shipping', 'shipping.shipping_id', 'order_details.shipping_id')
            ->join('Product', 'order_details.Product_id', 'Product.Product_id')
            ->where('order_details.customer_id', $customer_id)->where('order_details.order_id', $order_id)->get();
        $menu = $this->Menu->show();
        $pho = $this->User->find(Auth::id());

        $Invoice = [
            'amount' => 1,
            'show_detal' => $show_detal,
        ];
        $user = User::where('id', $customer_id)->get();
//        $user->notify(new InvoicePaidNotification($Invoice));
        Notification::send($user, new InvoicePaidNotification($Invoice));
    }


    public function dss()
    {
        $show_rec = products::with(['photo'])->active()->limit(9)
            ->orderBy('Product_id', 'desc')->get();

        return view('test.te1', compact('show_rec'));
    }
}
