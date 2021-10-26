<?php

namespace App\Http\Controllers;

use App\order_details;
use App\Repository\OrderRtepository\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\orders;

class manege_order extends Controller
{
    /**
     * @var OrderRepositoryInterface
     */
    protected $Order;

    public function __construct(OrderRepositoryInterface $Order)
    {

        $this->Order = $Order;
    }
    public function show_manage(){

        $all_table_order=$this->Order->show();
        abort_if(!$all_table_order,404);
        return view('admin.manage_order',compact('all_table_order'));
    }
    public function vi_order($order_id){
        $order_by_id=$this->Order->find_all($order_id);
        abort_if(!$order_by_id,404);

        return view('admin.view_order',compact('order_by_id'));
    }
    public function del_manage($order_id){
        $value =$this->Order->delete($order_id);
        if ($value)
        return redirect::to('/admin/admin_order/manage_order');
    }
}
