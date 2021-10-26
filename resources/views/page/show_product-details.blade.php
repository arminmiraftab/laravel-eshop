@extends('layout')
@section('content-right')

    <div class="container">
        <div class="row">
            <div class="col-sm-12  ">
                <div class="product-details col-lg-12"><!--product-details-->
                    <div class="col-sm-5 ">


                        <div id="similar-product" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                @php $I=0@endphp
                                @foreach($show_Pro_pro->flatMap->photo as $dat3 )

                                    @php $I++;@endphp
                                    @if($I==1)
                                        <div class="item active  " style="
                                                max-width: 300px;
                                                max-height: 450px;
                                                min-width: 250px;
                                                min-height:450px;
                                                ">
                                            @else
                                                <div class="item" style="
                                                max-width: 300px;
                                                max-height: 450px;
                                                min-width: 250px;
                                                min-height:450px;
                                                ">
                                                    @endif
                                                    <a href=""><img src="{{URL::to($dat3->imageable_path)}} "
                                                                    width="300px" height="450px" alt=""></a>
                                                </div>
                                                @endforeach
                                        </div>
                                        <a class="left item-control" href="#similar-product" data-slide="prev">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                        <a class="right item-control" href="#similar-product" data-slide="next">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                            </div>
                        </div>
                        @foreach($show_Pro_pro as $dat)

                            <div class="col-sm-7">
                                <div class="product-information"><!--/product-information-->
                                    <img src="{{asset('FRONTED/images/product-details/new.jpg')}}"
                                         class="newarrival')}}" alt=""/>
                                    <h2>{{$dat->Product_name}}</h2>

                                    <p>{{$dat->Product_short_description}}</p>
                                    <br>
                                    <span><span>{{$dat->Product_price."ریال"}}</span>
                                <form action="{{url('cart/add_card')}}" method="post">
                                {{csrf_field()}}

                                    <label>تعداد :</label>
                            <input name="qty" type="text" value="1"/>
                            <input type="hidden" name="Product_id" value="{{$dat->Product_id}}"/>
                                <button type="submit" class="btn  btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										اضافه به سبد خرید
									</button>
                            </form>
								</span>
                                    <p><b>وضعیت:</b>
                                    <p style="color: #00A300">موجود</p> </p>

                                    <p><b>برند : </b><br>
                                        {{$dat->brand->manufacture_name}}</p>
                                </div><!--/product-information-->
                            </div>
                    </div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                <li><a href="#details" data-toggle="tab">توضیحات</a></li>
                                <li><a href="#companyprofile" data-toggle="tab">نظرات</a></li>

                                <li class="active"><a href="#reviews" data-toggle="tab">ثبت نظرات</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade" id="details">
                                <div class="col-sm-12">
                                    <ul>
                                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                        <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                        <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                    </ul>
                                    <p>{{$dat->Product_long_description}}</p>
                                    <p><b>Write Your Review</b></p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="companyprofile">
                                <div class="review_list">
                                    <div class="review_item">

                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</p>
                                    </div>
                                    @foreach($comment as $for)
                                        <div class="review_item">
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="{{asset('image/profile.png')}}" height="60px" width="60px"
                                                         alt="">
                                                </div>
                                                <div class="media-body">
                                                    <h4>{{$for->customer_name}}</h4>
                                                    <h5>{{$for->title}}</h5>
                                                </div>
                                            </div>
                                            <p>{{$for->content}}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="tab-pane fade active in" id="reviews">
                                <div class="col-sm-12">
                                    <ul>
                                        <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                                        <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                                        <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                                    </ul>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                                        dolore eu fugiat nulla pariatur.</p>
                                    <p><b>Write Your Review</b></p>

                                    <form method="get" action="{{url('comment/'.$dat->Product_id)}}">
                                        {{csrf_field()}}
                                        @if(session()->has('message'))
                                            <div class="alert alert-success">
                                                {{ session()->get('message') }}
                                            </div>
                                        @endif
                                        <?php   $detal = Session::put('detal', null);

                                        if ($detal) {

                                            Session::put('detal', null);
                                        }
                                        ?>

                                        <span>
											<input type="text" value="{{old('cate')}}"
                                                   class="{{ $errors->has('cate') ? ' is-invalid' : '' }}"
                                                   placeholder="نام" name="cate"/>
                                            @if ($errors->has('cate'))
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cate') }}</strong>
                                    </span>
                                            @endif
										</span>
                                        <textarea name="tex">{{old('tex')}} </textarea>
                                        @if ($errors->has('tex'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tex') }}</strong>
                                    </span>
                                        @endif
                                        <b>Rating: </b> <img src="images/product-details/rating.png')}}" alt=""/>
                                        <input type="submit" value="ثبت"/>
                                    </form>
                                </div>
                            </div>

                        </div>


                    </div><!--/category-tab-->

                    @endforeach
                </div>
                {{--         @include('category')--}}
            </div>
        </div>
@endsection

