<?php

namespace App\Http\Controllers;

use App\Http\Requests\shippingRequest;
use App\Repository\CategoryRtepository\CategoryRtepositoryInterface;
use App\Repository\ColorRtepository\ColorRtepositoryInterface;
use App\Repository\ManufactureRtepository\ManufactureRtepositoryInterface;
use App\Repository\MenuRepository\MenuRtepositoryInterface;
use App\Repository\OrderRtepository\Order_DetailRepositoryInterface;
use App\Repository\OrderRtepository\OrderRepositoryInterface;
use App\Repository\ProductsRtepository\ProductsRtepositoryInterface;
use App\Repository\ShippingRepository\ShippingRepositoryInterface;
use App\Repository\UserRepository\UserRtepositoryInterface;
use App\User;
use Illuminate\Http\Request;
use App\colormodel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Menu;
use App\categorys;
use App\manufactures;
use App\customermol;
use App\orders;
use App\shippings;
use App\payments;
use App\order_details;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class panel_user extends Controller
{

    /**
     * @var UserRtepositoryInterface
     */
    protected $User;
    /**
     * @var MenuRtepositoryInterface
     */
    protected $Menu;
    /**
     * @var ShippingRepositoryInterface
     */
    protected $Shipping;
    /**
     * @var OrderRepositoryInterface
     */
    protected $Order;
    /**
     * @var Order_DetailRepositoryInterface
     */
    private $Order_Detail;

    public function __construct(
        ShippingRepositoryInterface $Shipping,
        OrderRepositoryInterface $Order,
        Order_DetailRepositoryInterface $Order_Detail,
        MenuRtepositoryInterface $Menu,
         UserRtepositoryInterface $User

    )
    {

        $this->User = $User;
        $this->Menu = $Menu;
        $this->Shipping = $Shipping;
        $this->Order = $Order;
        $this->Order_Detail = $Order_Detail;
    }


    public function user_panel_map(){
        $customer_id = Auth::id();
        $menu =  $this->Menu->show();
        $pho =$this->User->find($customer_id);
        abort_if(!$customer_id||!$menu||!$pho,404);

        return view('page.map',compact('menu','pho'));
    }
    public function create_shipp(shippingRequest $request){
        $value=$this->Shipping->store($request);
         if ($value)
        return redirect::to('/panel_user/map_show');

    }
    public function view_panel_pay(){
        $customer_id = Auth::id();
        $order=$this->Order->find_Order_User($customer_id);
        $date=Carbon::now()->timestamp;
        $menu = $this->Menu->show();
        $pho = $this->User->find($customer_id);
        abort_if(!$customer_id||!$menu||!$pho||!$date||!$order,404);

        return view('page.show_pay',
            compact('menu','pho','order','date'));
    }
    public function view_panel_pay_detal($order_id){
        $date=Carbon::now()->timestamp;
        $customer_id = Auth::id();
        $show_detal=$this->Order_Detail->order_details_user($customer_id,$order_id);
        $menu =  $this->Menu->show();
        $pho=$this->User->find(Auth::id());
        abort_if(!$customer_id||!$menu||!$pho||!$date||!$show_detal,404);

        return view('page.show_pay_detal'
            ,compact('menu','pho','show_detal','date'));
    }
    public function add_deta_user(){
        $menu = $this->Menu->show();
        $pho=$this->User->find(Auth::id());
        abort_if(!$menu||!$pho,404);

        return view('page.detal_user', compact('menu','pho'));
    }
    protected function validator($data){
        $messages = [
            'name.max' => trans('Validation.user.name.max'),
            'last_name.max' => trans('Validation.user.last_name.max'),
            'email.max' => trans('Validation.user.email.max'),
            'password.max' => trans('Validation.user.password.max'),
            'phone_number.max' => trans('Validation.user.phone_number.max'),
            'National_Code.max' =>trans('Validation.user.National_Code.max'),
            'name.required' => trans('Validation.user.description.required'),
            'last_name.required' => trans('Validation.user.last_name.required'),
            'email.required' => trans('Validation.user.email.required'),
            'email.email' => trans('Validation.user.email.email'),
            'password.required' => trans('Validation.user.password.required'),
            'password.confirmed' => trans('Validation.user.password.confirmed'),
            'password.min' => trans('Validation.user.password.min'),
            'phone_number.required' =>trans('Validation.user.phone_number.required'),
            'phone_number.numeric' => trans('Validation.user.phone_number.numeric'),
            'National_Code.required' =>trans('Validation.user.National_Code.required'),
            'National_Code.numeric' => trans('Validation.user.National_Code.numeric'),



        ];
        return Validator::make($data->all(), [
            'first_name' => 'required|string',
            'last_name' => 'string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobail' => 'required|numeric',
            'Code_nmber' => 'required|numeric',
        ],$messages);
    }
    public function save_deta_user(Request $request){
        $validation=$this->validator($request);
        if ($validation->fails()) {
            return response()->json(['error' => $validation->errors()]);
        } else {
            $value=$this->User->update($request,Auth::id());
            if ($value)
                return response()->json($request);
        }
    }
    public function user_panel_map_show(){
        $shop=$this->Shipping->find_all();
        $menu =$this->Menu->show();
        $pho=$this->User->find(Auth::id());
        abort_if(!$menu||!$pho||!$shop,404);

        return view('page.show_map'
            ,compact('shop','menu','pho'));

    }
    public function mines_map_to_list($id){
        if ($this->Shipping->delete($id))
        return redirect::to('panel_user/map_show');
    }
    // order_details
    public function pay_set($id){
        $pdata=array();
        $pdata['payment_method']='handcach';
        $pdata['payment_status']='پرداخت شد';
        $payment_id=payments::insertGetId($pdata);
        $this->Order->update_Column_pay($id,' پرداخت شد');
//        $ds=orders::where('order_id',$id)->update(['order_status'=>' پرداخت شد']);
        $ds=order_details::where('order_id',$id)->update(['state_fa'=>1]);
        return Redirect::to('panel_user/pay_detal/'.$id);

    }
    // order_details
    public function pay_dis($id){
        $ds=  $this->Order->update_Column_pay($id,' لغو شد');
        $ds=order_details::where('order_id',$id)->update(['time_fa'=>1]);
        return Redirect::to('panel_user/pay_detal/'.$id);

    }
}
