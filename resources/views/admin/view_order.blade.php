@extends('admin_panel')
@section('content')
    <div class="row-fluid">
        <div class="col-md-6  span5">
            <div class="tile">
                <h3 class="tile-title">اطاعات مشتری</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>نام کاربری</th>
                        <th>موبایل</th>
                        <th>ایمیل</th>
                        <th>کدملی</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>

                        <td>{{$order_by_id[0]->user['name']}} {{$order_by_id[0]->user['last_name']}} </td>
                        <td>{{$order_by_id[0]->user['phone_number']}}</td>
                        <td>{{$order_by_id[0]->user['email']}}</td>
                        <td>{{$order_by_id[0]->user['National_Code']}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6  span6">
            <div class="tile">
                <h3 class="tile-title">جزیات حمل نقل</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ادرس</th>
                        <th>پلاک</th>
                        <th>واحد</th>
                        <th>کد پستی</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>1</td>
                        <td>{{$order_by_id[0]->address['shipping_adderss_map']}}</td>
                        <td>{{$order_by_id[0]->address['House_number']}}</td>
                        <td>{{$order_by_id[0]->address['shipping_unit']}}</td>
                        <td>{{$order_by_id[0]->address['shipping_code_post']}}</td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="col-md-6  ">
        <div class="tile">
            <h3 class="tile-title">مشخصات سفارش</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>اسم کالا</th>
                    <th>قیمت</th>
                    <th>تعداد</th>
                    <th> مجموع قیمت هاهر کالا</th>
                    <th>وضعیت</th>
                </tr>
                </thead>
                <tbody>
                <?php  $total = 0 ?>

                @php  $i=1; @endphp
                @foreach($order_by_id as $dat)
                    @foreach($dat->order_details as $data)
                        <tr>
                            <td>{{$i++}}</td>

                            <td>{{$data->Product_name}}</td>
                            <td>{{$data->Product_price}}</td>
                            <td>{{$data->Product_sales_quantity}}</td>
                            <td>{{$data->Product_price*$data->Product_sales_quantity}}</td>
                            <td>{{$dat->order_status}}</td>
                            <?php  $total += $data->Product_price * $data->Product_sales_quantity ?>

                        </tr>
                    @endforeach
                @endforeach

                </tbody>
            </table>
            <P>  <?php  echo $total ?> :مجموع پرداخت </P>
        </div>
    </div>
@endsection