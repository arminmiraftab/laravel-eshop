@extends('conent_left')
@section('content-panel')
    <div class="container mt-lg-5" style="margin-top: 32px">
    <table class="table table-bordered text-center">
        <thead style="background-color: #fe980f">
        <tr>
            <th class="text-center" scope="col">#</th>
            <th class="text-center" scope="col">کد سفارش</th>
            <th class="text-center" scope="col">تاریخ ثبت سفارش</th>
            <th class="text-center" scope="col">مبلغ کل</th>
            <th class="text-center" scope="col">عملیات پرداخت</th>
            <th class="text-center" scope="col">جزییات</th>
        </tr>
        </thead>
        <tbody>
        <?php $g=1;
        ?>

        @foreach($order as $ord)

                <tr>
            <th scope="row" class="text-center table_order_pay"><?php  echo $g++;?></th>
            <td class="text-center table_order_pay">{{$ord->order_id}}</td>
            <td class="text-center table_order_pay">{{$ord->created_at}}</td>
            <td class="text-center table_order_pay">{{$ord->order_total}}</td>
                    @if($ord->state_fa==1)
                <td class="text-center table_order_pay">پرداخت شده</td>
            @elseif($ord->state_fa==0 && $ord->time_fa>$date)
                <td class="text-center table_order_pay">درحال انتظار</td>
            @elseif($ord->state_fa==0 && $ord->time_fa<$date)
                <td class="text-center table_order_pay"> لغوشد</td>
            @endif

                    <td><div class="table_order_pay_btn"><a class="cart_quantity_delete table_order_pay align-self-center justify-content-center justify-content-center" href="{{URL::to('panel_user/pay_detal/'.$ord->order_id)}}"><i class="fa fa-angle-left"></i></a></div></td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="text-center">
        {{ $order->links() }}</div>

    </div>
@endsection
