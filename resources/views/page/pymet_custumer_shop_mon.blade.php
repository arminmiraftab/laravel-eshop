@extends('layout')
@section('content-right')
    <div class="container">
        <div class="row">

            <div class="col-sm-10 ">

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
                                                <a class="cart_quantity_up"
                                                   href="{{URL::to('payment/plus_pay/'.$cont->rowId.'/'.$cont->qty)}}">
                                                    + </a>
                                                <input class="cart_quantity_input" type="text" name="quantity"
                                                       value="{{$cont->qty}}" autocomplete="off" size="2">
                                                <a class="cart_quantity_down"
                                                   href="{{URL::to('payment/min_pay/'.$cont->rowId.'/'.$cont->qty)}}">
                                                    - </a>
                                            </div>
                                        </td>
                                        <td class="cart_total">
                                            <p class="cart_total_price">{{$cont->total}}</p>
                                        </td>
                                        <td class="cart_delete">

                                            <a class="cart_quantity_delete"
                                               href="{{URL::to('payment/delet_pay/'.$cont->rowId)}}"><i
                                                        class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <p class="alert-danger text-center">
                        <?php
                        $message = Session::get('customer_adres');
                        if ($message) {
                            echo $message;
                            Session::put('customer_adres', null);
                        }
                        ?>
                    </p>
                    <div class="pymentCont ">
                        <div class="headingWrap">
                            <form action="{{url('payment/order_place')}}" method="post">
                                {{csrf_field()}}
                                <div class="col-sm-11">
                                    <div class="chose_area">
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <div style="margin-left: 6.5%">
                                        <label class=" control-label" for="selectError2">انتخاب ادرس</label>
                                        <div class="controls">
                                            <select data-placeholder="انتخاب ادرس" id="selectError2" data-rel="chosen"
                                                    name="shipping_id" required>
                                                <option value="null">-- ادرس --</option>
                                                <?php foreach($adres as $dat){?>
                                                <option value="{{$dat->shipping_id}}">{{$dat->shipping_address}}</option>

                                                <?php }?>

                                            </select>
                                        </div>

                                    </div>
                                    <div class="total_area">
                                        <ul>
                                            <li>مجموع سبد خرید <span id="subtotal">{{Cart::subtotal()}}</span></li>
                                            <li>مالیات <span id="tax">{{Cart::tax()}}</span></li>
                                            <li>هزینه حمل و نقل <span>Free</span></li>
                                            <li>کل هزینه ها <span id="total">{{Cart::total()}}</span></li>
                                        </ul>

                                        @if(!empty($adres[0])&& $conents!=null)
                                            <button class="btn btn-default update" type="submit" id="r">انجام</button>
                                        @else
                                            <a href="{{url('panel_user/map')}}" class="p-5 btn"
                                               style="margin-top: 10px">ثبت ادرس</a>

                                        @endif

                                    </div>
                                </div>

                                <div class="row m-auto">
                                </div>
                            </form>

                        </div>
                    </div>

                </section>
                <section id="do_action">
                    <div class="container">
                        <div class="heading">

                        </div>
                        <div class="row">


                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>
    <script>
        $(document.body).on("click", ".valids", f);

        function f() {
            var id = $(this).attr('data-cartid');
        }
    </script>
@endsection