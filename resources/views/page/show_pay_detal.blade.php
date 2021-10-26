@extends('conent_left')
@section('content-panel')
    <div class="container mt-lg-5" style="margin-top: 32px">
        <table class="table table-bordered text-center">
            <thead style="background-color: #fe980f">
            <tr>
                <th class="text-center" scope="col">#</th>
                <th class="text-center" scope="col">عکس</th>
                <th class="text-center" scope="col">نام محصول</th>
                <th class="text-center" scope="col">تعداد</th>
                <th class="text-center" scope="col">مبلغ</th>
                <th class="text-center" scope="col">ادرس</th>
                <th class="text-center" scope="col">عملیات پرداخت</th>
            </tr>
            </thead>
            <tbody>
            <?php $g = 1;?>
            @foreach($show_detal as $ord)
                <tr>
                    <th scope="row" class="text-center table_order_pay"><?php echo $g++;?></th>

                    <td class="text-center table_order_pay"><a href="">
                            @if($ord->order_photo->first_photo==1)
                                <img src="{{URL::to($ord->order_photo->imageable_path)}}" height="70px" width="70px"
                                     alt="">
                            @endif
                        </a></td>
                    <td class="text-center table_order_pay">{{$ord->Product_name}}</td>
                    <td class="text-center table_order_pay">{{$ord->Product_sales_quantity}}</td>
                    <td class="text-center table_order_pay">{{$ord->Product_price}}</td>
                    <td class="text-center table_order_pay">{{$ord->shipping_address}}</td>
                    @if($ord->state_fa==1)
                        <td class="text-center table_order_pay">
                            <div class="d-flex justify-content-between text-success "
                                 style="font-size: medium;">پرداخت شده </div>
                        </td>
                    @elseif($ord->state_fa==0 && $ord->time_fa>$date)
                        <td>
                            <div class="d-flex justify-content-between" style="">
                                <form action="{{url('payment/pay/'.$ord->order_id)}}" method="post">
                                    {{csrf_field()}}
                                <button
                                   class="d-flex justify-content-between" style="border-radius: 8px;
    border: 1px solid #c4c4c4;
    padding: 11px 0;
    margin: 0;
    background-color: transparent;
    color: #a9a9a9;
    -webkit-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out;
    display: block;
    width: auto;
    text-align: center;
    font-size: 15px;">الان پرداخت می کنم</button>
                                </form>

                            </div>
                        </td>
                    @elseif($ord->state_fa==0 && $ord->time_fa<$date)
                        <td>
                            <div class="d-flex justify-content-between" style=""><a href=""
                                                                                    class="d-flex justify-content-between"
                                                                                    style="border-radius: 8px;
    border: 1px solid #c4c4c4;
    padding: 11px 0;
    margin: 0;
    background-color: transparent;
    color: #a9a9a9;
    -webkit-transition: all .3s ease-in-out;
    transition: all .3s ease-in-out;
    display: block;
    width: auto;
    text-align: center;
    font-size: 15px;"> لغوشد</a></div>
                        </td>

                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
