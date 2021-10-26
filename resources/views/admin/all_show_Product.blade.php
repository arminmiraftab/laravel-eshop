@extends('admin_panel')
@section('content')



    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('/Dashboard')}}">خانه</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">محصولات</a></li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>محصولات</h2>

                <div class="box-icon">

                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>

                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>

            </div>
            <ul class="noty_cont noty_layout_topRight notificati" id="#notificati">
            </ul>
            <div class="box-content">


                <table class="table  table-bordered  padding-0" id="userTable">
                    <thead>

                    <tr>
                        <th style="padding: 0;">id</th>
                        <th style="padding: 0;">نام</th>
                        <th style="padding: 0;">برند</th>
                        <th style="padding: 0;">دسته</th>
                        <th style="padding: 0;">توضیحات کوتاه</th>
                        <th style="padding: 0;">توضیحات بلند</th>
                        <th style="padding: 0;">عکس محصولات</th>
                        <th style="padding: 0;">انداره</th>
                        <th style="padding: 0;">وضعیت</th>
                        <th style="padding: 0;">توصیه شده</th>
                        <th style="padding: 0;">action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
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
                url: "{{ route('Fetch.Product') }}",
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    console.log(response);

                    var len = 0;
                    var color_status;
                    var color_recommended;
                    var name_recommended;
                    var name_status;
                    var act;
                    $('#userTable tbody').empty(); // Empty <tbody>
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }

                    if (len > 0) {
                        var Null='نامشخص ';

                        for (var i = 0; i < len; i++) {
                            // console.log(response['data'][i].brand.manufacture_name);
                            var image = 'image/none-600x600.png';
                           var manufacture_name= Null;
                           var category_name= Null;
                            var id = response['data'][i].Product_id;
                            var name = response['data'][i].Product_name;
                            // var image = response['data'][i].Product_image;
                            if ((response['data'][i].photo).length)
                             image = response['data'][i].photo[0].imageable_path;
                            if ((response['data'][i].category)!=null)
                            category_name = response['data'][i].category.category_name;
                            var color_id = response['data'][i].color_id;
                            if ((response['data'][i].brand)!=null)
                                 manufacture_name = response['data'][i].brand.manufacture_name;
                            var size = response['data'][i].Product_size;
                            var price = response['data'][i].Product_price;
                            var long_description = response['data'][i].Product_long_description;
                            var short_description = response['data'][i].Product_short_description;
                            var status = response['data'][i].Product_status;
                            var recommended = response['data'][i].recommended;
                            if(id==null) {id = Null;}
                            if(name==null) {name = Null;}
                            if(long_description==null) {long_description = Null;}
                            if(short_description==null) {short_description = Null;}
                            if(color_id==null) {color_id = Null;}
                            if(size==null) {size = Null;}


                            if (recommended == 1) {
                                color_recommended = "success";
                                name_recommended = "Active";
                            }
                            else {
                                color_recommended = "important";
                                name_recommended = "Banned";

                            } 
                            if (image.length==2) {
                                image='http://127.0.0.1:8000/image/none-600x600.png';
                            }
                            // console.log(image.length);
                          

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

                            var tr_str = "<tr style='padding: 0;'>" +
                                "<td align='center'>" + (i + 1) + "</td>" +
                                "<td style='padding: 0;' class='center'>" + name + "</td>" +
                                "<td style='padding: 0;' class='center'>" + manufacture_name + "</td>" +
                                "<td style='padding: 0;' class='center'>" + category_name + "</td>" +
                                "<td style='padding: 0;' class='center'>" + short_description + "</td>" +
                                "<td style='padding: 0;' class='center'>" + long_description + "</td>" +
                                "<td style='padding: 0;' class='center'><img src='/" + image + "' alt=''></td>" +
                                "<td align='center' style='padding: 0;' class='center'>" + size + "</td>" +
                                "<td align='center'> <span  class='label label-" + color_status + "'>" + name_status + "</span></td>" +
                                "<td align='center'> <span  class='label label-" + color_recommended + "'>" + name_recommended + "</span></td>" +
                                "<td align='center'><button class='btn btn-success state_act'  id='" + id + "' name='state'><i class='halflings-icon thumbs-" + act + "'></i></button> <a class='btn btn-info'   href='/admin/admin_Product/edit_Product/" + id + "'><i class='halflings-icon white edit'></i></a> <button name='delet' id='" + id + "' class='btn btn-danger delet'><i class='halflings-icon white trash'></i></button> <button name='rcom' id='" + id + "' class='btn btn-warning recommended'><i class='fa fa-heart' aria-hidden='true'></i></button> </td>" +
                                "</tr>";

                            $("#userTable tbody").append(tr_str);
                            // console.log(tr_str)
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

        $("table").on("click", ".delet", deleteProduct);

        function deleteProduct() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr("id");
            // console.log(id);

            $.ajax({
                url: "{{ route('delete.Product') }}",
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
                    }                        // console.log(result);
                },
            })
        }

        $("table ").on("click", ".state_act", stste_Product);

        function stste_Product() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr("id");
            // console.log(id);

            $.ajax({
                url: "{{ route('Act.diact.Product') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                success: function (result) {
                    fetchRecords();
                    // console.log(result);
                    if (result.error) {
                        notif(result.error)
                    }
                    if (result.success) {
                        notif(result.success, 'success');
                    }
                    // console.log(result.success);
                },
                error: function (result) {
                    // console.log(result);
                    if (result.error) {
                        notif(result.error)
                    }
                    // alert('error');
                },
            })
        }

        $("table tbody").on("click", ".recommended", stste_recom);

        function stste_recom() {
            let _token = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr("id");
            // console.log(id);

            $.ajax({
                url: "{{ route('Act.diact.recommended') }}",
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
                    // console.log(result.success);
                },
                error: function (result) {
                    // console.log(result);
                    if (result.error) {
                        notif(result.error)
                    }
                },
            })
        }


    </script>
@endsection