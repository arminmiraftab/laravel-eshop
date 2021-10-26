@extends('layout')
@section('content-right')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">

                <section id="cart_items">
                    <div class="container">
                        <div class="breadcrumbs">
                            <ol class="breadcrumb">
                                <li><a href="#">Home</a></li>
                                <li class="active">Shopping Cart</li>
                            </ol>
                        </div>
                        <div class="table-responsive cart_info col-sm-8 " style="padding: 0 1px;">
                            <?php   $conents = Cart::content()?>
                            <table class="table table-condensed ">
                                <thead>
                                <tr class="cart_menu">
                                    <td class="image">محصول</td>
                                    <td class="description">نام</td>
                                    <td class="price">قیمت</td>
                                    <td class="quantity">تعداد</td>
                                    <td class="total">پرداختی شما</td>
                                    <td>حذف</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($conents as $cont )
                                    <tr>
                                        <td class="cart_product">
                                            <a href=""><img src="{{'../../'.$cont->options->image}}" height="80px"
                                                            width="80px" alt=""></a>
                                        </td>
                                        <td class="cart_description">
                                            <h4>
                                                <a href="{{URL::to('product/product-details/'.$cont->id)}}">{{$cont->name}}</a>
                                            </h4>
                                            <p></p>
                                        </td>
                                        <td class="cart_price">
                                            <p>{{$cont->price}}</p>
                                        </td>
                                        <td class="cart_quantity">
                                            <div class="cart_quantity_button">
                                                <a class="cart_quantity_up cursor-poin" style="cursor: pointer"
                                                   name="plus_cars" data-cartid="{{$cont->rowId}}"> + </a>
                                                {{--<input type="button"  id="demo"  class="dan" value="+">--}}
                                                <input class="cart_quantity_input states" type="text" name="quantity"
                                                       value="{{$cont->qty}}" size="2">
                                                {{--<a class="cart_quantity_down" name="minus_cars" onclick="{{$cont->rowId}}"  data-cartid="{{$cont->rowId}}"   href="{{URL::to('cart/min_card/'.$cont->rowId.'/'.$cont->qty)}}"> - </a>--}}
                                                <a class="cart_quantity_down" name="minus_cars"
                                                   data-cartid="{{$cont->rowId}}" href="#"> - </a>
                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price total-cart">{{$cont->total}}</p>
                                        </td>
                                        <td class="cart_delete">

                                            <a class="cart_quantity_delete"
                                               href="{{URL::to('cart/delet_card/'.$cont->rowId)}}"><i
                                                        class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </section>
                <section id="do_action">
                    <div class="container">
                        <div class="heading">
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="total_area">
                                    <ul>
                                        <li>مجموع سبد خرید <span id="subtotal">{{Cart::subtotal()}}</span></li>
                                        <li>مالیات <span id="tax">{{Cart::tax()}}</span></li>
                                        <li>هزینه حمل و نقل <span>Free</span></li>
                                        <li>کل هزینه ها <span id="total">{{Cart::total()}}</span></li>
                                    </ul>

                                    <a class="btn btn-default check_out" href="{{URL::to('payment/payment')}}">ادامه خرید</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            {{--    @include('category')--}}
        </div>
    </div>
    <script src="{{asset('FRONTED/js/jquery.js')}}"></script>
    <script>

        function fetchRecords() {
            $.ajax({
                url: "{{ route('cart.list') }}",
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    document.getElementById("subtotal").innerHTML = response.total;
                    document.getElementById("tax").innerHTML = response.tax;
                    document.getElementById("total").innerHTML = response.total;

                }
            });
        }

        $(".cart_quantity_down").click(function (event) {
            event.preventDefault();


            var id = $(this).attr('data-cartid');
            // var qrt = $('input[name=quantity]').val();
            var qrt = $(this).siblings(".states").val();
            let _token = $('meta[name="csrf-token"]').attr('content');
            console.log(qrt);
            // var qrt2= $(this).siblings(".states").val()=;
            var element = $(this);

            if (qrt > 1) {
                $.ajax({
                    url: "{{ route('cart.mines') }}",
                    type: "POST",
                    data: {
                        cart_id: id,
                        qrt: qrt,
                        _token: _token
                    },
                    success: function (response) {
                        if (response) {
                            fetchRecords();
                            element.siblings(".states").val(response.qrt);
                            element.parent().parent().siblings(".cart_total").find('.total-cart').text(response.total);
                        }
                    },
                });
            }


        });

        $(".cart_quantity_up").click(function (event) {
            event.preventDefault();

            var id = $(this).attr('data-cartid');
            var qrt = $(this).siblings(".states").val();
            let _token = $('meta[name="csrf-token"]').attr('content');
            var element = $(this);
            console.log(qrt);

            $.ajax({
                url: "{{ route('cart.plus') }}",
                type: "POST",
                data: {
                    cart_id: id,
                    qrt: qrt,
                    _token: _token
                },
                success: function (response) {
                    console.log(response);
                    if (response) {
                        fetchRecords();
                        console.log(response);
                        element.siblings(".states").val(response.qrt);
                        element.parent().parent().siblings(".cart_total").find('.total-cart').text(response.total);
                    }


                },
            });
        });

        function myFunction(param) {
            var product_id = param;
            console.log(product_id);
        }
    </script>
@endsection
