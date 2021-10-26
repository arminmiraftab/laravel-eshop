@extends('admin_panel')
@section('content')



    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('/Dashboard')}}">خانه</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">اسلایدر</a></li>
    </ul>
    <ul class="noty_cont noty_layout_topRight notificati" id="#notificati" >
    </ul>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>اسلایدر</h2>

                <div class="box-icon">

                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>

                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>

            </div>

            <div class="box-content">
                <p class="text-center alert-success">
                    <?php
                    $messa=Session::get('messagea');
                    if($messa){
                        echo $messa;
                        Session::put('messagea',null);
                    }

                    $message=Session::get('message');
                    if($message){
                        echo $message;
                        Session::put('message',null);
                    }
                    ?></p>
                <table id="userTable" class="table  table-bordered ">
                    <thead>

                    <tr>
                        <th>id</th>

                        <th>عکس محصولات </th>

                        <th>سر موضوع</th>
                        <th>موضوع</th>
                        <th>توتضیحات</th>
                        <th>اسم لینک</th>
                        <th>لینک</th>
                        <th>status</th>

                        <th>action</th>
                    </tr>
                    </thead>
{{--                    @foreach($all_slider_table as $dat)--}}
                        <tbody>
                        {{--<tr>--}}
                            {{--<td>{{$dat->slider_id}}</td>--}}
                            {{--<td class="center"> <img src="{{URL::to($dat->slider_image)}}" style="width:80px;height:80px" alt=""></td>--}}
                            {{--<td class="center">{{$dat->sub_category_slider}}</td>--}}
                            {{--<td class="center">{{$dat->category_slider}}</td>--}}
                            {{--<td class="center">{{$dat->detal_slider}}</td>--}}
                            {{--<td class="center">{{$dat->submit_slider}}</td>--}}
                            {{--<td class="center">{{$dat->submit_link}}</td>--}}
                            {{--<td class="center">--}}
                                {{--@if($dat->slider_status==1)--}}
                                    {{--<span class="label label-success">Active</span>--}}
                                {{--@else--}}
                                    {{--<span class="label label-important">Banned</span>--}}
                                {{--@endif--}}
                            {{--</td>--}}
                            {{--<td class="center">--}}
                                {{--@if($dat->slider_status==1)--}}

                                    {{--<a class="btn btn-success" href="{{URL::to('/admin/admin_slider/Banne_slider/'.$dat->slider_id)}}">--}}
                                        {{--<i class="halflings-icon thumbs-up"></i>--}}
                                    {{--</a>--}}
                                {{--@else--}}
                                    {{--<a class="btn btn-success" href="{{URL::to('/admin/admin_slider/Active_slider/'.$dat->slider_id)}}">--}}
                                        {{--<i class="halflings-icon thumbs-up"></i>--}}
                                    {{--</a>--}}
                                {{--@endif--}}

                                {{--<a class="btn btn-danger " href="{{URL::to('/admin/admin_slider/delet_slider/'.$dat->slider_id)}}">--}}
                                    {{--<i class="halflings-icon white trash"></i>--}}

                                {{--</a>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        </tbody>
                    {{--@endforeach--}}
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->
    <script src="{{asset('FRONTED/js/jquery.js')}}"></script>

    <script type='text/javascript'>
        fetchRecords();
        function notif(msg,color=null){
            // var color ="success";
            $('.notificati').empty();
            if (color=='success') {
                $(".notificati").append('<li class="clearwe" "><div  class="noty_bar noty_theme_default noty_layout_topRight  notify_success" id="noty_error_1626790693041" style="cursor: pointer; display: block;">' +
                    '<div class="noty_message">' +
                    ' <span class="noty_text">' + msg + '</span></div></div></li>');
            } else {
                $(".notificati").append('<li class="clearwe" "><div  class="noty_bar noty_theme_default noty_layout_topRight noty_error" id="noty_error_1626790693041" style="cursor: pointer; display: block;">' +
                    '<div class="noty_message">' +
                    ' <span class="noty_text">' + msg + '</span></div></div></li>');
            }
            $('.notificati').show('fast').delay(3000).hide('slow');
        }

        function fetchRecords(){
            $.ajax({
                url: "{{ route('fech.slider') }}",
                type: 'get',
                dataType: 'json',
                success: function(response){
                    console.log(response);

                    var len = 0;
                    $('#userTable tbody').empty(); // Empty <tbody>
                    if(response['data'] != null){
                        len = response['data'].length;
                    }

                    if(len > 0){
                        var Null='نامشخص ';
                        var image = 'image/none-600x600.png';

                        for(var i=0; i<len; i++){
                            var id = response['data'][i].slider_id;
                            if ((response['data'][i].photo).length)
                                 image = response['data'][i].photo[0].imageable_path;
                            var sub_category_slider = response['data'][i].sub_category_slider;
                            // var category_slider = response['data'][i].category_slider;
                            var detal_slider = response['data'][i].detal_slider;
                            var submit_slider = response['data'][i].submit_slider;
                            var submit_link = response['data'][i].submit_link;
                            var status = response['data'][i].slider_status;
                            var color_status;
                            var name_status;
                            var act;
                            if(id==null) {id = Null;}
                            if(sub_category_slider==null) {sub_category_slider = Null;}
                            if(detal_slider==null) {detal_slider = Null;}
                            if(submit_slider==null) {submit_slider = Null;}
                            if(submit_link==null) {submit_link = Null;}

                            if(status==1) {
                                color_status = "success";
                                act = "up";
                                name_status = "Active";


                            }
                            else {
                                color_status = "important";
                                act = "down";
                                name_status = "Banned";

                            }

                            var tr_str = "<tr style='padding: 0;'>" +
                                "<td align='center'>" + (i+1) + "</td>" +
                                "<td style='padding: 0;' class='center'><img src='/"+image+"' style='width:80px;height:80px' alt=''></td>" +
                                "<td style='padding: 0;' class='center'>" + sub_category_slider + "</td>" +
                                "<td style='padding: 0;' class='center'>" + sub_category_slider + "</td>" +
                                "<td style='padding: 0;' class='center'>" + detal_slider + "</td>" +
                                "<td style='padding: 0;' class='center'>" +submit_slider + "</td>" +
                                "<td style='padding: 0;' class='center'>" +submit_link + "</td>" +
                                "<td align='center'> <span  class='label label-" + color_status + "'>" + name_status + "</span></td>" +
                                "<td align='center'><button class='btn btn-success state_act'  id='"+id+"' name='state'><i class='halflings-icon thumbs-"+act+"'></i></button> <a class='btn btn-info'   href='/admin/admin_slider/edit_slider/"+id+"'><i class='halflings-icon white edit'></i></a> <button name='delet' id='"+id+"' class='btn btn-danger delet'><i class='halflings-icon white trash'></i></button>  </td>" +
                                "</tr>";
                            // console.log(tr_str);

                            $("#userTable tbody").append(tr_str);
                        }
                    }else{
                        var tr_str = "<tr>" +
                            "<td align='center' colspan='4'>No record found.</td>" +
                            "</tr>";

                        $("#userTable tbody").append(tr_str);
                    }

                }
            });
        }

    $("table tbody").on("click", ".delet", delete_slider);

    function delete_slider() {
        let _token = $('meta[name="csrf-token"]').attr('content');
        var id = $(this).attr("id");
        // console.log(id);

        $.ajax({
            url:"{{ route('delet.slider') }}",
            type:"POST",
            data: {
                id:id ,
                _token: _token
            },
            success: function(result) {
                fetchRecords();
                if (result.success) {
                    notif(result.success,'success');
                }
                if (result.error) {
                    notif(result.error);}
                // console.log(result);
            },
        })}

    $("table").on("click", ".state_act", stste_slider);

    function stste_slider() {
        let _token = $('meta[name="csrf-token"]').attr('content');
        var id = $(this).attr("id");
        // console.log(id);

        $.ajax({
            url:"{{ route('Act.diact.slider') }}",
            type:"POST",
            data: {
                id:id ,
                _token: _token
            },
            success: function(result) {
                fetchRecords();
                console.log(result);
                if (result.success) {
                    notif(result.success,'success');
                }
                if (result.error) {
                    notif(result.error);}
            },
            error: function(result) {
                // console.log(result);
                notif(result.error);

            },
        })}




    </script>

@endsection