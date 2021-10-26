@extends('admin_panel')
@section('content')

    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('admin/Dashboard')}}">خانه</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">توصیه شده ها</a></li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>توصیه شده ها</h2>

                <div class="box-icon">

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
                        <th>id</th>
                        <th> عکس محصول</th>
                        <th>نام محصول</th>
                        <th>وضعیت</th>
                        <th>حالت</th>
                    </tr>
                    </thead>
                    @foreach($all_slider_table as $dat)
                        <tbody>
                        <tr>
                            <td>{{$dat->Product_id}}</td>
                            @foreach($dat->photo as $data)
                                @if($data->first_photo==1)
                                    <td class="center"><img src="{{URL::to($data->imageable_path)}}"
                                                            style="width:80px;height:80px" alt=""></td>
                                @endif
                            @endforeach
                            <td class="center">{{$dat->Product_name}}</td>
                            <td class="center">
                                @if($dat->recommended==1)
                                    <span class="label label-success">Active</span>
                                @else
                                    <span class="label label-important">Banned</span>
                                @endif
                            </td>
                            <td class="center">
                                <a class="btn btn-success"
                                   href="{{URL::to('admin/admin_RECOMMENDED/Active_recomm/'.$dat->Product_id)}}">
                                    <i class="halflings-icon thumbs-up"></i>
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