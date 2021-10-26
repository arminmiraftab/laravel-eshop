@extends('layout')
@section('content-right')

    <style>
    </style>
    <head>

        <link href="{{asset('f/style.css')}}" rel="stylesheet">
        <link href="{{asset('f/responsive.css')}}" rel="stylesheet">

        <link href="{{asset('f/theme4.css')}}" rel="stylesheet" media="all">
    </head>
    <div class="home_left_main_area " style="direction: rtl">

        <div class="left_menu">
            <div class="offcanvas_fixed_menu">

                <div class="input-group search_form">
                <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button"><i
                                        class="icon-magnifier icons"></i></button>
                        </span>
                </div>
                <div class="account2">

                    @if($pho->name && $pho->last_name!=NULL )
                        <h4 class="name ">{{$pho->name}} {{$pho->last_name}}</h4>

                    @else
                        <h4 class="name ">{{$pho->email}}</h4>

                    @endif

                    <a href="{{URL::to('panel_user/logout_customer')}}">خروج</a>
                </div>

                <div class="offcanvas_menu">
                    <ul class="nav nav_right_menu flex-column">
                        <li>
                            <a href="{{URL::to('panel_user/view_pay')}}">
                                <i class="fa fa-cart-arrow-down"></i>همه سفارش‌ها
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::to('panel_user/map')}}">
                                <i class="fa fa-ambulance"></i>ثبت ادرس</a>

                        </li>
                        <li>
                            <a href="{{URL::to('panel_user/map_show')}}">
                                <i class="fa fa-truck"></i>ادرس ها</a>
                        </li>


                        <li>
                            <a href="{{URL::to('panel_user/user_data')}}">
                                <i class="fa fa-user"></i>اطلاعات شخصی</a>
                        </li>


                    </ul>
                </div>

            </div>
        </div>
        <div class="right_body">
            @yield('content-panel')
        </div>

    </div>

@endsection
