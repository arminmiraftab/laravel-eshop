@extends('admin_panel')
@section('content')



    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('/Dashboard')}}">خانه</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="{{url('/admin_category/show-CATEGORY')}}">دسته</a></li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>دسته</h2>

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
                <table class="table  table-bordered " id="userTable">
                    <thead>

                    <tr>
                        <th align="center" style="text-align: center !important">id</th>
                        <th align="center" style="text-align: center !important">نام</th>
                        <th align="center" style="text-align: center !important">توضیحات</th>
                        <th align="center" style="text-align: center !important">وضیعت</th>
                        <th align="center" style="text-align: center !important">وضیعت</th>
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
                url: "{{ route('fetch.category') }}",
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
                        var image = 'image/none-600x600.png';

                        for (var i = 0; i < len; i++) {
                            var id = response['data'][i].category_id;
                            var name = response['data'][i].category_name;
                            var status = response['data'][i].category_status;
                            var description = response['data'][i].category_description;
                            var act;
                            var status_category;
                            var color_status;
                            if(id==null) {id = Null;}
                            if(description==null) {description = Null;}
                            if(name==null) {name = Null;}
                            // var ID_cart_save;
                            if (status == 1) {
                                color_status = "success";
                                act = "up";
                                status_category = "Active";
                            } else {
                                color_status = "important";
                                act = "down";
                                status_category = "Banned";
                            }


                            var tr_str = "<tr style='padding: 0;'>" +
                                "<td style='padding: 0;text-align: center;' class='center'>" + (i + 1) + "</td>" +
                                "<td style='padding: 0;text-align: center;' class='center'>" + name + "</td>" +
                                "<td style='padding: 0;text-align: center' class='center'>" + description + "</td>" +
                                "<td style='padding: 0;text-align: center' align='center '> <span  class='label label-" + color_status + "'>" + status_category + "</span></td>" +

                                "<td style='text-align: center;'  align='center'> <button class='btn btn-success state_act'  id='" + id + "' name='state'><i class='halflings-icon thumbs-" + act + "'></i></button> <a class='btn btn-info'   href='/admin/admin_category/edit_CATEGORY/" + id + "'><i class='halflings-icon white edit'></i></a> <button name='delet' id='" + id + "' class='btn btn-danger delet'><i class='halflings-icon white trash'></i></button> </td>" +
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

        $("table tbody").on("click", ".delet", delete_category);

        function delete_category() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr("id");
            $.ajax({
                url: "{{ route('delete.category') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                success: function (result) {
                    fetchRecords();
                    if (result.success) {
                        notif(result.success, 'success')
                    }
                    if (result.error) {
                        notif(result.error)
                    }
                },
            })
        }

        $("table").on("click", ".state_act", stste);

        function stste() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr("id");
            console.log(id);

            $.ajax({
                url: "{{ route('act.diact.category') }}",
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