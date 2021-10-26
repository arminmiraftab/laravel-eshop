<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Home | E-Shopper</title>
    <link href="{{asset('FRONTED/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('FRONTED/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('FRONTED/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('FRONTED/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('FRONTED/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('FRONTED/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('FRONTED/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('FRONTED/css/main3.css')}}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src={{asset('FRONTED/js/html5shiv.js')}}"></script>
    <script src="{{asset('FRONTED/js/respond.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBW0td9v69m95iy5Q2YiMebpIO7ztCnuPU&language=fa" ></script>
    <script src="{{asset('FRONTED/js/googelmap.js')}}"></script>
    <script src="{{asset('FRONTED/js/jquery.js')}}"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
    </script>
    <![endif]-->
    <link rel="shortcut icon" href="{{URL::to('FRONTED/images/ico/favicon.ico')}}">
    <link rel="{{URL::to('FRONTED/apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="{{URL::to('FRONTED/apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="{{URL::to('FRONTED/apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png')}}">

    <link rel="{{URL::to('FRONTED/apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png')}}">
    <link href="{{asset('fontawesome/css/brands.min.css')}}" rel="stylesheet">
    <link href="{{asset('fontawesome/css/fontawesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('fontawesomes/css/solid.min.css')}}" rel="stylesheet">
    {{--<link id="base-style" href="{{asset('backend/css/style.css')}}" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{asset('fontawesome/css/font-awesome.min.css')}}">
    <link href="{{asset('theme/css/jquery-ui.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
    </script>
    {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBW0td9v69m95iy5Q2YiMebpIO7ztCnuPU&language=fa" ></script>--}}

    <style>
        #myMap {
            height: 350px;
            width: 680px;
        }
    </style>
</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class=" fa fa-address-book"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{route('Home')}}"><img src="{{asset('FRONTED/images/home/logo.png')}}" alt="" /></a>
                    </div>

                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{URL::to('/admin/Dashboard')}}"><i class="fa fa-shopping-cart"></i> ادمین </a></li>

                        @if(Auth::check())
                            <?php $shipping_id=Session::get('shipping_id');?>
                                @auth
                            <li><a href="{{URL::to('panel_user/view_pay')}}"><i class="fa fa-user"></i> حساب کاربری</a></li>
                                @endauth
                            <li><a href="{{URL::to('payment/payment')}}"><i class="fa fa-crosshairs"></i> برسی</a></li>
                            <li><a href="{{URL::to('cart/card')}}"><i class="fa fa-shopping-cart"></i> سبد</a></li>


                                <li><a href="{{ route('logout') }}"><i class="fa fa-lock"></i> خروج</a></li>
                            @else
                                <li><a href="{{URL::to('panel_user/login_clint')}}"><i class="fa fa-lock"></i> ورود</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-3 " >
                    {{--<div class="form-one">--}}
                        {{--<form>--}}
                            {{--<input type="text" placeholder="Title">--}}
                            {{--<button  class="search_box"><i class="fa fa-arrow-circle-o-right"></i></button>--}}

                        {{--</form>--}}
                    {{--</div>--}}
                    <form action="{{ route('search').'/'}}" method="get" class="">

                    <div class="search_box pull-left">
                        <input type="text" name="product" placeholder="Search"/>
                        <button type="submit" class="search_box"><i class="fa fa-arrow-circle-o-right"></i></button>

                    </div>
                    </form>

                </div>
                {{--<div class="col-sm-10" style="padding-left: 48.6%">--}}
                <div class="col-sm-9" >

                <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            @foreach($menu as $item)
                                @if ($item->submenu->count())
                                    <li class="dropdown"><a href="#">{{$item->name}}<i class="fa fa-angle-down"></i></a>
                                        <ul role="menu" class="sub-menu">
                                            @foreach ($item->submenu as $subitem)
                                                <li><a href="http://{{$subitem->link}}">{{$subitem->name}}</a></li>
                                            @endforeach
                                        </ul>
                                </li>
                                    @else
                                    <li class="dropdown"><a href="#">{{$item->name}}<i class=""></i></a>

                                @endif

                            @endforeach


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

<!--/slider-->

<section>

            @yield('content-right')


</section>

<footer id="footer"><!--Footer-->


    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Service</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Online Help</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Order Status</a></li>
                            <li><a href="#">Change Location</a></li>
                            <li><a href="#">FAQ’s</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Quock Shop</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">T-Shirt</a></li>
                            <li><a href="#">Mens</a></li>
                            <li><a href="#">Womens</a></li>
                            <li><a href="#">Gift Cards</a></li>
                            <li><a href="#">Shoes</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>Policies</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privecy Policy</a></li>
                            <li><a href="#">Refund Policy</a></li>
                            <li><a href="#">Billing System</a></li>
                            <li><a href="#">Ticket System</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Company Information</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Store Location</a></li>
                            <li><a href="#">Affillate Program</a></li>
                            <li><a href="#">Copyright</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-sm-offset-1">
                    <div class="single-widget">
                        <h2>About Shopper</h2>
                        <form action="#" class="searchform">
                            <input type="text" placeholder="Your email address" />
                            <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                            <p>Get the most recent updates from <br />our site and be updated your self...</p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->


<script src="{{asset('FRONTED/js/jquery.js')}}"></script>

<script src="{{asset('FRONTED/js/bootstrap.min.js')}}"></script>
<script src="{{asset('FRONTED/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('FRONTED/js/price-range.js')}}"></script>
<script src="{{asset('FRONTED/js/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('FRONTED/js/main.js')}}"></script>

</body>
</html>