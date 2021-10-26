<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div class="container mt-lg-5" style="margin-top: 32px">
    <table class="table table-bordered text-center">
        <thead style="background-color: #fe980f">
        <tr>
            <th class="text-center" scope="col">#</th>
            {{--<th class="text-center" scope="col">عکس</th>--}}
            <th class="text-center" scope="col">نام محصول</th>
            <th class="text-center" scope="col">تعداد</th>
            <th class="text-center" scope="col">مبلغ</th>
            <th class="text-center" scope="col">ادرس</th>
        </tr>
        </thead>
        <tbody>
        <p>new</p>
        <?php $g=1;?>
        @foreach($show_detal as $ord)
            <tr>
                <th scope="row" class="text-center table_order_pay"><?php echo $g++;?></th>

                <td class="text-center table_order_pay"> <a href="">

                    </a></td>
                <td class="text-center table_order_pay">{{$ord->Product_name}}</td>
                <td class="text-center table_order_pay">{{$ord->Product_sales_quantity}}</td>
                <td class="text-center table_order_pay">{{$ord->Product_price}}</td>
                <td class="text-center table_order_pay">{{$ord->shipping_address}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
