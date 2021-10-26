@extends('admin_panel')
@section('content')


    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('/Dashboard')}}">خانه</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="{{url('/admin_manufacture/allmanufacture')}}">برند</a></li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>برند</h2>

                <div class="box-icon">

                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>

                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>

            </div>

            <div class="box-content">
                <ul class="noty_cont noty_layout_topRight notificati" id="#notificati">
                </ul>
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
                <table id='userTable' class="table  table-bordered ">
                    <thead>

                    <tr>
                        <th>id</th>
                        <th>نام</th>
                        <th>توضیحات</th>
                        <th>وضیعت</th>
                        <th>وضیعت</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->


    <script src="{{asset('FRONTED/js/jquery.js')}}"></script>

    <script type='text/javascript'>
        function notif(msg, color = null) {
            // var color ="success";
            $('.notificati').empty();
            if (color == 'success') {
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

        fetchRecords();

        function fetchRecords() {
            $.ajax({
                url: "{{ route('Fetch.manufacture') }}",
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    console.log(response);

                    var len = 0;
                    $('#userTable tbody').empty(); // Empty <tbody>
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }

                    if (len > 0) {
                        var Null='نامشخص ';

                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].manufacture_id;
                            var name = response['data'][i].manufacture_name;
                            var description = response['data'][i].manufacture_description;
                            var status = response['data'][i].manufacture_status;
                            var color_status;
                            var name_status;
                            var act;
                            if(id==null) {id = Null;}
                            if(name==null) {name = Null;}
                            if(description==null) {description = Null;}

                            if (status == 1) {
                                color_status = "success";
                                act = "up";
                                name_status = "Active";


                            }
                            else {
                                color_status = "important";
                                act = "down";
                                name_status = "Banned";

                            }

                            var tr_str = "<tr>" +
                                "<td align='center'>" + (i + 1) + "</td>" +
                                "<td align='center'>" + name + "</td>" +
                                "<td align='center'>" + description + "</td>" +
                                "<td align='center'> <span  class='label label-" + color_status + "'>" + name_status + "</span></td>" +
                                "<td align='center'><button class='btn btn-success state_act'  id='" + id + "' name='state'><i class='halflings-icon thumbs-" + act + "'></i></button> <a class='btn btn-info'   href='/admin/admin_manufacture/edit_manufacture/" + id + "'><i class='halflings-icon white edit'></i></a> <button name='delet' id='" + id + "' class='btn btn-danger delet'><i class='halflings-icon white trash'></i></button> </td>" +
                                "</tr>";

                            $("#userTable tbody").append(tr_str);
                        }
                    } else {
                        var tr_str = "<tr>" +
                            "<td align='center' colspan='4'>No record found.</td>" +
                            "</tr>";

                        $("#userTable tbody").append(tr_str);
                    }

                }
            });
        }

        $("table").on("click", ".delet", deleteUser);

        function deleteUser() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr("id");
            console.log(id);

            $.ajax({
                url: "{{ route('delete.manufacture') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                success: function (result) {
                    fetchRecords();
                    if (result.error) {
                        notif(result.error)
                    }
                    if (result.success) {
                        notif(result.success, 'success');
                    }
                },
                error: function (result) {
                    console.log(result);

                    notif(result.success, 'success');
                },
            })
        }

        $("table tbody").on("click", ".state_act", stste_brand);

        function stste_brand() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr("id");
            console.log(id);

            $.ajax({
                url: "{{ route('Act.diact') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                success: function (result) {
                    fetchRecords();
                    if (result.error) {
                        notif(result.error)
                    }
                    if (result.success) {
                        notif(result.success, 'success');
                    }
                },
                error: function (result) {
                    console.log(result);

                    notif(result.success, 'success');
                },
            })
        }
    </script>



@endsection