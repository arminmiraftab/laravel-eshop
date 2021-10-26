@extends('layout')
@section('content-right')

    <div class="container ">

        <div class="row">
            <section id="slider"><!--slider-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach($sliders as $dat)
                                        @if($i==0)
                                            <li data-target="#slider-carousel" data-slide-to="" class="active"></li>
                                            <?php $i++; ?>
                                        @else
                                            <li data-target="#slider-carousel" data-slide-to=""></li>
                                        @endif
                                    @endforeach

                                </ol>

                                <div class="carousel-inner">
                                    <?php
                                    $i = 1;
                                    foreach($sliders as $dat){
                                    if ($i == 1){
                                    ?>
                                    <div class="item active">
                                        <?php }else{?>
                                        <div class="item">
                                            <?php }?>
                                            <div class="col-sm-6">

                                                <h1>{{$dat->sub_category_slider}}</h1>
                                                <h2>{{$dat->category_slider}}</h2>
                                                <p>{{$dat->detal_slider}} </p>

                                                <a class="sub-silder"
                                                   href="{{$dat->submit_link}}">{{$dat->submit_slider}}</a>
                                            </div>
                                            <div class="col-sm-6">
                                                @foreach($dat->photo as $data)
                                                    <img src="{{asset($data->imageable_path)}}"
                                                         class="girl img-responsive" alt=""
                                                         style="height:430px;width:100%"/>
                                                @endforeach
                                                <img src="" class="pricing" alt=""/>
                                            </div>
                                        </div>


                                        <?php $i++; }?>

                                    </div>

                                    <a href="#slider-carousel" class="left control-carousel hidden-xs"
                                       data-slide="prev">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                    <a href="#slider-carousel" class="right control-carousel hidden-xs"
                                       data-slide="next">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
            </section>
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="col-sm-12 col-lg-12 padding-right">
                            <div class="features_items" id="updateDiv"><!--features_items-->
                                <h2 class="title text-center">محصولات</h2>
                                @foreach($show_Product as $dat)
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    @foreach($dat->photo as $data)
                                                        @if($data->first_photo)
                                                            <img src="{{asset($data->imageable_path)}}"
                                                                 alt="{{$data->imageable_alt}}" style="height: 300px;">
                                                        @endif
                                                    @endforeach
                                                    <h2>{{$dat->Product_price}}</h2>
                                                    <p>{{$dat->Product_name}}</p>
                                                    <a href="{{URL::to('product/product-details/'.$dat->Product_id)}}"
                                                       class="btn btn-default add-to-cart"><i
                                                                class="fa fa-shopping-cart"></i>اضافه به سبد خرید</a>
                                                </div>
                                                <div class="product-overlay">
                                                    <div class="overlay-content">
                                                        <h2>{{$dat->Product_price}}</h2>
                                                        <p>{{$dat->Product_name}}</p>
                                                        <a href="{{URL::to('product/product-details/'.$dat->Product_id)}}"
                                                           class="btn btn-default add-to-cart"><i
                                                                    class="fa fa-shopping-cart"></i>اضافه به سبد
                                                            خرید</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="choose">
                                                <ul class="nav nav-pills nav-justified">
                                                    <li><a href="#"><i class="fa fa-plus-square"></i>اضافه کردن به علاقه
                                                            مندی</a></li>
                                                    <li>
                                                        <a href="{{URL::to('product/product-details/'.$dat->Product_id)}}"><i
                                                                    class="fa fa-plus-square"></i>نمایش محصول</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div><!--features_items-->
                        </div>
                    </div>
                </div>
                @include('recommended')
            </div>
        </div>
    </div>
@endsection