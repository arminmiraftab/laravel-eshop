@extends('admin_panel')
@section('content')



    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('/Dashboard')}}">خانه</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">نظرات</a></li>
    </ul>
    <ul class="noty_cont noty_layout_topRight notificati" id="#notificati">
    </ul>


    <div class="span11">


        <div class="priority low"><span>نظرات</span></div>
        <ul class="noty_cont noty_layout_topRight notificati" id="#notificati">
        </ul>
        <div id="contact_comment" class="contact_comment">

        </div>
        <div class="clearfix"></div>

    </div>

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
                url: "{{ route('fetch.comment') }}",
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    console.log(response);

                    var len = 0;
                    $('#contact_comment').empty(); // Empty <tbody>
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }

                    if (len > 0) {
                        var Null='نامشخص ';
                        var name = Null;
                        // var name_pro = Null;
                        var image = 'image/none-600x600.png';
                        for (var i = 0; i < len; i++) {

                            var id = response['data'][i].id;
                            if ((response['data'][i].user)!=null)
                                 name = response['data'][i].user.name;
                            var title = response['data'][i].title;
                            if ((response['data'][i].comment_photo)!=null)
                                 image = response['data'][i].comment_photo.imageable_path;
                            var id_pro = response['data'][i].Product_id;
                            var content = response['data'][i].content;
                            // var last_name = response['data'][i].phone_number;
                            var satat = response['data'][i].status;
                            if ((response['data'][i].prodoct)!=null)
                                 name_pro = response['data'][i].prodoct.Product_name;
                            var status_comment;
                            var comment_color;
                            if(id==null) {id = Null;}
                            if(name==null) {name = Null;}
                            if(name_pro==null) {name = Null;}
                            if(title==null) {title = Null;}
                            if(content==null) {content = Null;}

                            // var ID_cart_save;
                            if (satat == null) {
                                status_comment = "منتظره تایید";
                                comment_color = "";
                            }
                            if (satat == 2) {
                                status_comment = "رد شد";
                                comment_color = "-important";
                            }
                            if (satat == 1) {
                                status_comment = "تایید شد";
                                comment_color = "-success";
                            }
                            // if(ID_cart==null) {ID_cart_save = "هنوز وارد نشده";}else {ID_cart_save=ID_cart;}
                            // $(".mes_comment").append('<button type="button" class=" x btn show_more btn-mini" data-toggle="modal" data-target="#'+'M'+id+'_'+id+'"> sho </button>');


                            var tr_str =


                                '<div id="id="' + title + '" class="task low"> <div class="desc" style="width: 72%"><div class="content " ><span>' +
                                '<a href="#" > <img class="avatar comment-image"  height="100%" alt="Dennis Ji" src="/' + image + '">' +
                                '</a></span> <span><strong class="float-le">نام محصول:</strong> <a href="#">' + name_pro + '</a></span><br>' +
                                '<span><strong class="float-le">عنوان :</strong> ' + title + ' </span><br>' +
                                '<p id="' + 'c' + id + '_' + id + '_' + id + '"   class="contentsss comment-content "> <strong class="float-le">متن :  </strong>' + content + ' </p> <br> ' +
                                '<span class="mes_comment"><button type="button" class="btn show_more btn-mini" data-toggle="modal" data-target="#' + 'M' + id + '_' + id + '"> مشاهده بیشتر </button> </span> <br>' +
                                '<span><strong class="float-le">نام فرسنده :</strong> ' + name + '</span><br>' +
                                '<span><strong class="float-le">وضعیت:</strong> <span style="padding: 1px 7px;" class="label' + comment_color + ' "> ' + status_comment + '</span></span></div></div>' +
                                '<div class="time" style="width: 18%"> <div class="date validdddddd" style="display: inline-block; float: left">Jun 1, 2012</div>' +
                                '<span style="display: inline-block "> <button value="2"  id="' + id + '" class="btn valids btn-round"><i class="fa fa-times" aria-hidden="true"></i></button>' +
                                '<button id="' + id + '" value="1"  class="btn btn-primary btn-round valids"><i class="halflings-icon white ok"></i></button> </span> </div> </div>' +

                                '<div class="' + id + ' modal hide fade" id="' + 'M' + id + '_' + id + '">' +
                                '<div class="modal-header"> <button type="button" class="close" data-dismiss="modal">×</button>' +
                                '<h3>' + title + '</h3> </div> <div  class="text-break "> <p id="more_text" class="text-break pl-lg-2" style=" padding-left: 3%;padding-right: 3%; overflow-wrap: break-word;">' + content + '</p>' +
                                '</div > <div  class="modal-footer valids"> <button href="#" id="' + id + '" value="2" class="btn valids"  data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>' +
                                '<button id="' + id + '" value="1" data-dismiss="modal" class="btn btn-primary valids"><i class="halflings-icon white ok"></i></button> </div> </div>';

                            $(".contact_comment").append(tr_str);

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


        $(document.body).on("click", ".valids", deleteProduct);

        function deleteProduct() {

            let _token = $('meta[name="csrf-token"]').attr('content');
            var id = $(this).attr("id");
            var val = $(this).attr("value");
            console.log(id);
            console.log(val);

            $.ajax({
                url: "{{ route('rejected.comment') }}",
                type: "POST",
                data: {
                    id: id,
                    val: val,
                    _token: _token
                },
                success: function (result) {
                    fetchRecords();
                    console.log(result.repeat);
                    if (result.repeat) {
                        notif(result.repeat)
                    }
                    if (result.success) {
                        notif(result.success, 'success');
                    }
                },
            })
        }


    </script>


@endsection