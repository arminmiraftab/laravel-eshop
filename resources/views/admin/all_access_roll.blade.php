@extends('admin_panel')
@section('content')



    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('/Dashboard')}}">خانه</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">کاربران سایت</a></li>
    </ul>
    <ul class="noty_cont noty_layout_topRight notificati" id="#notificati">
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>کاربران سایت</h2>

                <div class="box-icon">

                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>

                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>

            </div>

            <div class="box-content">

                <table id="userTable" class="table  table-bordered ">
                    <thead>

                    <tr>
                        <th>#</th>

                        <th align="center" style="text-align: center !important">نام نام خانوادگی</th>

                        <th align="center" style="text-align: center !important">ایمیل</th>
                        <th align="center" style="text-align: center !important">همراه</th>
                        <th align="center" style="text-align: center !important">شماره ملی</th>
                        <th align="center" style="text-align: center !important">فعالیت</th>

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
                url: "{{ route('fetch.rule') }}",
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    // console.log(response);

                    var len = 0;
                    $('#userTable tbody').empty(); // Empty <tbody>
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }

                    if (len > 0) {
                        var Null='نامشخص ';
                        for (var i = 0; i < len; i++) {
                            var id =response['data'][i].id;
                            console.log(response);

                            var name = response['data'][i].name;
                            var last = response['data'][i].last_name;
                            if ((response['data'][i].roll)!=null)
                                var status_rule = response['data'][i].roll.name;
                            // var rule = response['data'][i].roll;
                            var email = response['data'][i].email;
                            var phone = response['data'][i].phone_number;
                            var ID_cart = response['data'][i].National_Code;
                            // var status_rule;
                            var phone_save;
                            var ID_cart_save;
                            if(name==null) {name = Null;}
                            if(last==null) {last = Null;}
                            if(status_rule==null) {status_rule = Null;}
                            if(email==null) {email = Null;}


                            if (phone == null) {
                                phone_save = "هنوز وارد نشده";
                            } else {
                                phone_save = phone;
                            }
                            if (ID_cart == null) {
                                ID_cart_save = "هنوز وارد نشده";
                            } else {
                                ID_cart_save = ID_cart;
                            }
                            // console.log(tr_str);

                            var tr_str = "<tr style='padding: 0;'>" +
                                "<td align='center'>" + (i + 1) + "</td>" +
                                "<td style='padding: 0;text-align: center;' class='center'>" + name + " " + last + "</td>" +
                                "<td style='padding: 0;text-align: center' class='center'>" + email + "</td>" +
                                "<td style='padding: 0;text-align: center' class='center'>" + phone_save + "</td>" +
                                "<td style='padding: 0;text-align: center' class='center'>" + ID_cart_save + "</td>" +
                                "<td align='center'> <a class='btn btn-info'   href='/admin/Edite_roll/" + id + "'><i class='halflings-icon white edit'></i></a> <button name='delet' id='" + id + "' class='btn btn-danger delet'><i class='halflings-icon white trash'></i></button>  </td>" +
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

        $("table tbody").on("click", ".delet", delete_rule);

        function delete_rule() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr("id");
            $.ajax({
                url: "{{ route('delet.rule') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                success: function (result) {
                    fetchRecords();
                    console.log(result);
                    if (result.success) {
                        notif(result.success, 'success')
                    }
                    if (result.error) {
                        notif(result.error)
                    }
                },
            })
        }


    </script>

@endsection