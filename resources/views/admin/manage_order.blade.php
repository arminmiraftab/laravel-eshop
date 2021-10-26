@extends('admin_panel')
@section('content')



    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('/admin/Dashboard')}}">خانه</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">سفارشات</a></li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>سفارشات</h2>

                <div class="box-icon">
                    <
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>

                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>

            </div>

            <div class="box-content">
                <p class="text-center alert-success">
                    <?php
                    $messa = Session::get('messagea');
                    if ($messa) {
                        echo $messa;
                        Session::put('messagea', null);
                    }

                    $message = Session::get('message');
                    if ($message) {
                        echo $message;
                        Session::put('message', null);
                    }
                    ?></p>
                <table class="table  table-bordered ">
                    <thead>

                    <tr>
                        <th>order_id</th>
                        <th>نام کاربری</th>
                        <th>جمع سفارشات</th>
                        <th>وضعیت</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
{{--                    {{($all_table_order)}}--}}
                    @foreach($all_table_order as $dat)
                        <tbody>
                        <tr>
                            <td>{{$dat->order_id}}</td>
{{--{{dd($dat)}}--}}
                            <td class="center">{{isset($dat->user['name']) ? ($dat->user['name']) : 'نامشخص'}}{{isset($dat->user['last_name'])? ($dat->user['last_name']): ''}}</td>
                            {{--@endforeach--}}
                            <td class="center">{{$dat->order_total}}</td>
                            <td class="center">{{$dat->order_status}}</td>
                            <td class="center">
                                <a class="btn btn-info"
                                   href="{{URL::to('/admin/admin_order/view_order/'.$dat->order_id)}}">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger "
                                   href="{{URL::to('/admin/admin_order/delet_mang/'.$dat->order_id)}}">
                                    <i class="halflings-icon white trash"></i>

                                </a>
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->





@endsection