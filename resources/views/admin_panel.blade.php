<!DOCTYPE html>
<html lang="en " ;>
<head>

    <!-- start: Meta -->
    <meta charset="utf-8">
    <title>usc</title>


    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <!-- end: Meta -->

    <!-- start: Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- end: Mobile Specific -->

    <!-- start: CSS -->
    <link id="bootstrap-style" href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
    <link id="base-style" href="{{asset('backend/css/style.css')}}" rel="stylesheet">
    <link id="base-style-responsive" href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext'
          rel='stylesheet' type='text/css'>
    <!-- end: CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>

    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <link id="ie-style" href="css/ie.css" rel="stylesheet">
    <![endif]-->

    <!--[if IE 9]>
    <link id="ie9style" href="css/ie9.css" rel="stylesheet">
    <![endif]-->

    <!-- start: Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- end: Favicon -->

    <link rel="stylesheet" href="{{asset('fontawesome/css/font-awesome.min.css')}}">
    <style>
        .hj {
            background-color: rgb(255, 102, 0) !important;

        }

        select:invalid {
            color: gray;
        }

        option {
            color: black;
        }
    </style>

</head>

<body>
<!-- start: Header -->
<div class="navbar ">
    <div class="navbar-inner">
        <div class="container-fluid">
            <a class="btn btn-navbar" data-toggle="collapse"
               data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="{{route('Home')}}"><span>  سلام{{' '.auth('admin')->user()->name}}</span></a>

            <!-- start: Header Menu -->
            <div class="nav-no-collapse header-nav">
                <ul class="nav pull-right">
                    <!-- start: Notifications Dropdown -->

                    <!-- start: User Dropdown -->
                    <li>
                        <a class="btn" href="#">
                            <i class="halflings-icon white wrench"></i>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="halflings-icon white user"></i> @php use Illuminate\Support\Facades\Auth;  Auth::user();
                            @endphp

                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu-title">
                                <span>Account Settings</span>
                            </li>
                            <li><a href="{{ route('logout.admin') }}"><i class="halflings-icon off"></i> Logout</a></li>
                        </ul>
                    </li>


                    <!-- end: User Dropdown -->
                </ul>
            </div>
            <!-- end: Header Menu -->

        </div>
    </div>
</div>
<!-- start: Header -->

<div class="container-fluid-full">
    <div class="row-fluid">

        <!-- start: Main Menu -->
        <div id="sidebar-left" class="span2">
            <div class="nav-collapse sidebar-nav">
                <ul class="nav nav-tabs nav-stacked main-menu">
                    <li><a href="{{URL::to('admin/Dashboard')}}"><i class="icon-bar-chart"></i><span
                                    class="hidden-tablet"> داشیورد </span></a></li>
                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet">  دسته بندی </span></a>
                        <ul>
                            <li><a class="submenu" href="{{URL::to('admin/admin_category/ADD-CATEGORY')}}"><i
                                            class="icon-file-alt"></i><span
                                            class="hidden-tablet"> اضافه کردن </span></a></li>
                            <li><a class="submenu" href="{{URL::to('admin/admin_category/show-CATEGORY')}}"><i
                                            class="icon-file-alt"></i><span class="hidden-tablet"> نمایش </span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> برند </span></a>
                        <ul>
                            <li><a class="submenu" href="{{URL::to('admin/admin_manufacture/add_manufacture')}}"><i
                                            class="icon-file-alt"></i><span
                                            class="hidden-tablet"> اضافه کردن برند </span></a></li>
                            <li><a class="submenu" href="{{URL::to('admin/admin_manufacture/allmanufacture')}}"><i
                                            class="icon-file-alt"></i><span
                                            class="hidden-tablet"> نمایش برند </span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> دسترسی ها </span></a>
                        <ul>
                            <li><a class="submenu" href="{{URL::to('admin/add_roll')}}"><i
                                            class="icon-file-alt"></i><span
                                            class="hidden-tablet"> اضافه کردن دسترسی  </span></a></li>
                            <li><a class="submenu" href="{{route('show.rule')}}"><i class="icon-file-alt"></i><span
                                            class="hidden-tablet"> نمایش کاربر ها </span></a></li>
                            <li><a class="submenu" href="{{route('show.rule.ADMIN')}}"><i class="icon-file-alt"></i><span
                                            class="hidden-tablet"> نمایش دسترسی ها </span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> محصولات </span></a>
                        <ul>
                            <li><a class="submenu" href="{{URL::to('admin/admin_Product/add_Product')}}"><i
                                            class="icon-file-alt"></i><span
                                            class="hidden-tablet"> اضافه کردن محصولات </span></a></li>
                            <li><a class="submenu" href="{{URL::to('admin/admin_Product/show_Product')}}"><i
                                            class="icon-file-alt"></i><span class="hidden-tablet"> نمایش محصولات </span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> اسلایدر </span></a>
                        <ul>
                            <li><a class="submenu" href="{{URL::to('admin/admin_slider/add_slider')}}"><i
                                            class="icon-file-alt"></i><span
                                            class="hidden-tablet"> اضافه کردن اسلایدر </span></a></li>
                            <li><a class="submenu" href="{{URL::to('admin/admin_slider/slider_admin')}}"><i
                                            class="icon-file-alt"></i><span class="hidden-tablet"> نمایش اسلایدر </span></a>
                            </li>
                        </ul>
                    </li>


                    <li>
                        <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> منو </span></a>
                        <ul>
                            <li><a class="submenu" href="{{URL::to('admin/add_menu')}}"><i
                                            class="icon-file-alt"></i><span
                                            class="hidden-tablet"> اضافه کردن  </span></a></li>
                            <li><a class="submenu" href="{{URL::to('/')}}"><i class="icon-file-alt"></i><span
                                            class="hidden-tablet"> نمایش  </span></a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('management.comment')}}"><i class="icon-edit"></i><span class="hidden-tablet"> مدریت نظرات</span></a>
                    </li>

                    <li><a href="{{URL::to('/admin/admin_order/manage_order')}}"><i class="icon-edit"></i><span
                                    class="hidden-tablet"> مدریت سفارشات</span></a></li>
                    <li><a href="{{URL::to('/admin/admin_RECOMMENDED/RECOMMENDED')}}"><i class="icon-list-alt"></i><span
                                    class="hidden-tablet"> نمایش توصیه شده ها</span></a></li>
                    <li><a class="submenu" href="https://fontawesome.com/v4.7.0/icons"><i
                                    class="icon-file-alt"></i><span class="hidden-tablet">ایکون ها </span></a></li>

                </ul>
            </div>
        </div>
        <!-- end: Main Menu -->

        <noscript>
            <div class="alert alert-block span10">
                <h4 class="alert-heading">Warning!</h4>
                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

        <!-- start: Content -->
        <div id="content" class="span10">


            @yield('content')


        </div><!--/.fluid-container-->

        <!-- end: Content -->
    </div><!--/#content.span10-->
</div><!--/fluid-row-->

<div class="modal hide fade" id="myModal">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3>Settings</h3>
    </div>
    <div class="modal-body">
        <p>Here settings can be configured...</p>
    </div>
    <div class="modal-footer">
        <a href="" class="btn" data-dismiss="modal">Close</a>
        <a href="#" class="btn btn-primary">Save changes</a>
    </div>
</div>

<div class="clearfix"></div>

<footer>


</footer>

<!-- start: JavaScript-->

<script src="{{asset('backend/js/jquery-1.9.1.min.js')}}"></script>
<script src="{{asset('backend/js/jquery-migrate-1.0.0.min.js')}}"></script>
<script src="{{asset('backend/js/jquery-ui-1.10.0.custom.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.ui.touch-punch.js')}}"></script>
<script src="{{asset('backend/js/modernizr.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.cookie.js')}}"></script>
<script src='{{asset('backend/js/fullcalendar.min.js')}}'></script>
<script src='{{asset('backend/js/jquery.dataTables.min.js')}}'></script>
<script src="{{asset('backend/js/excanvas.js')}}"></script>
<script src="{{asset('backend/js/jquery.flot.js')}}"></script>
<script src="{{asset('backend/js/jquery.flot.pie.js')}}"></script>
<script src="{{asset('backend/js/jquery.flot.stack.js')}}"></script>
<script src="{{asset('backend/js/jquery.flot.resize.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.chosen.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.uniform.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.cleditor.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.noty.js')}}"></script>
<script src="{{asset('backend/js/jquery.elfinder.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.raty.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.iphone.toggle.js')}}"></script>
<script src="{{asset('backend/js/jquery.uploadify-3.1.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.gritter.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.imagesloaded.js')}}"></script>
<script src="{{asset('backend/js/jquery.masonry.min.js')}}"></script>
<script src="{{asset('backend/js/jquery.knob.modified.js')}}"></script>
<script src="{{asset('backend/js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('backend/js/counter.js')}}"></script>
<script src="{{asset('backend/js/retina.js')}}"></script>
<script src="{{asset('backend/js/custom.js')}}"></script>
<!-- end: JavaScript-->

</body>
</html>
