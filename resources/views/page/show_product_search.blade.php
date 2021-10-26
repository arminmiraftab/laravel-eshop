@extends('layout')
@section('content-right')
    <div class="container">
        <div class="row">
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    @foreach($show_Pro_cat as $dat)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        @foreach($dat->photo as $data)
                                            @if($data->first_photo)
                                                <img src="{{asset($data->imageable_path)}}" alt=""
                                                     style="height: 300px;">
                                            @endif
                                        @endforeach
                                        <h2>{{$dat->Product_price}}</h2>
                                        <p>{{$dat->Product_name}}</p>
                                        <a href="{{URL::to('/product/product-details/'.$dat->Product_id)}}"
                                           class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>اضافه
                                            به سبد خرید</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>{{$dat->Product_price}}</h2>
                                            <p>{{$dat->Product_name}}</p>
                                            <a href="{{URL::to('/product/product-details/'.$dat->Product_id)}}"
                                               class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>اضافه
                                                به سبد خرید</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>اضافه کردن به علاقه مندی</a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>نمایش محصول</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div><!--features_items-->
                @include('recommended')
                @include('category')
            </div>

        </div>
    </div>

@endsection