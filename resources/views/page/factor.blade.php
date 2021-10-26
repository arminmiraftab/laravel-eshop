@extends('layout')
@section('content-right')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <section id="cart_items">
                    <div class="table-responsive cart_info col-sm-8 col-lg-12" style="padding: 0 1px;">
                        <table class="table table-condensed ">
                            <thead>
                            <tr class="cart_menu">
                                <td class="image">عکس</td>
                                <td class="description">نام</td>
                                <td class="price">قیمت</td>
                                <td class="total">مجموع پرداختی</td>
                                <td></td>
                            </tr>

                            </thead>
                            <form action="{{url('payment/pay/'.$total->order_id)}}" method="post">
                                {{csrf_field()}}
                            <tbody>
                            @foreach($factor as $cont )
{{--                                {{$cont->photo}}--}}
                                <tr>
                                    @foreach($cont->photo as $conts )
{{--{{$conts}}--}}
                                    @if($conts->first_photo==1)
                                    <td class="cart_product">
                                        <a href=""><img src="{{'../../'.$conts->imageable_path}}" height="80px"
                                                        width="80px" alt=""></a>
                                    </td>
                                    @endif
                                    @endforeach
                                    <td class="cart_description">
                                        <h4>
                                            <a href="{{URL::to('/p.i.roduct/product-details/'.$cont->Product_id)}}">{{$cont->Product_name}}</a>
                                        </h4>
                                        <p></p>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{$cont->Product_price}}</p>
                                    </td>
                                    @endforeach


                                    <td class="cart_total">
                                        <p class="cart_total_price">{{$total->order_total}}</p>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                        <div class="paymentWrap " style="margin-top: 56px;">
                            <div class="btn-group paymentBtnGroup btn-group-justified mt-5">
                                <label class="btn  paymentMethod active">
                                    <div><img src="{{asset('FRONTED/images/home/images.jpg')}}" alt=""/></div>
                                    <input type="radio" name="payment_gateway" value="handcach" checked>
                                </label>
                                <label class="btn paymentMethod ">
                                    <div><img src="{{asset('FRONTED/images/home/images.png')}}" alt=""/></div>
                                    <input type="radio" name="payment_gateway" value="two">

                                </label>
                                <label class="btn paymentMethod ">
                                    <div><img src="{{asset('FRONTED/images/home/imagesd.png')}}" alt=""/></div>
                                    <input type="radio" name="payment_gateway" value="tree">
                                </label>
                            </div>
                        </div>

                    </div>
                    @if ($dt<$time)
                        <button class="btn btn-success" type="submit" id="r">الان پرداخت می کنم</button>

                    @endif
                    <a class="btn btn-danger" href="{{URL::to('/')}}">بازگشت</a>
                    </form>

                </section>

            </div>


        </div>
    </div>
@endsection