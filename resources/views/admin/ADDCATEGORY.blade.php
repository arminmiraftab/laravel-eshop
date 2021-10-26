@extends('admin_panel')
@section('content')



        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{url('admin/Dashboard')}}">خانه</a>
                <i class="icon-angle-right"></i>
            </li>
            <li>
                <i class="icon-edit"></i>
                <a href="{{url('admin/admin_category/ADD-CATEGORY')}}">دسته</a>
            </li>
        </ul>

        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon edit"></i><span class="break"></span> اضافه کردن دسته</h2>
                    <div class="box-icon">
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form class="form-horizontal" id="prospects_form">
                        {{csrf_field()}}
                        <ul class="noty_cont noty_layout_topRight notificati" id="#notificati" >
                        </ul>

                        <p class="alert-success text-center" id="message-success">
                        </p>
                        <p class="alert-danger " id="element" >
                        </p>
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="name-category">اسم دسته</label>
                                <div class="controls">
                                    <input type="text" name="name_category" class="span6 typeahead" required id="name_category"  data-provide="typeahead" data-items="10"  data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>

                                </div>
                            </div>
                            <div class="control-group hidden-phone">
                                <label class="control-label" for="description-category">توضیحات دسته</label>
                                <div class="controls">
                                    <textarea class="cleditor"  name="description_category"  id="description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="CHECK">حالت نمایش</label>
                                <div class="controls">
                                    <input type="checkbox" class="span6 typeahead" id="CHECK" value="1" name="category_status" >
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" onclick="myFunction()" class="btn btn-primary">ثبت</button>
                                <button type="reset" class="btn">لغو</button>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div><!--/span-->

        </div><!--/row-->
        <script src="{{asset('FRONTED/js/jquery.js')}}"></script>

        <script>
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




                $("#prospects_form").submit(function (e) {
                    e.preventDefault();


                    let name = $('input[name=name_category]').val();
                    let descrip = document.getElementById("description").value;
                    let manu = $('input[name=category_status]:checked').val();
                    let _token = $('meta[name="csrf-token"]').attr('content');


                    // console.log(manu);
                    $.ajax({
                        url: "{{ route('cat.seve') }}",
                        type:"POST",
                        data:{
                            name:name,
                            description:descrip,
                            category_status:manu,
                            _token: _token
                        },
                        success:function(response){
                            if(response) {
                                console.log(response);
                                if (response.error){
                                    if (response.error.name){
                                        notif(response.error.name);

                                    }
                                    if (response.error.description){
                                        notif(response.error.description);

                                    }


                                }
                                if (response.success) {
                                    document.getElementById("prospects_form").reset();
                                    $("#description").val('').blur();
                                    notif(response.success,'success')  ;}
                            }
                        },
                        error: function(respons){
                            notif("در خواست با خطا مواجهه شد")
                        }
                    });
                });

        </script>



    @endsection