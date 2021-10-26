@extends('admin_panel')
@section('content')
    {{--<div id="content" class="span10">--}}


    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('/admin/Dashboard')}}">خانه</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#"> تصحیح برند</a>
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>دسته برند</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post"
                      action="{{url('/admin/admin_manufacture/EDIT_manufacture/')}}">
                    {{csrf_field()}}

                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="selectError2">انتخاب دسته</label>
                            <div class="controls">
                                <select data-placeholder="انتخاب دسته" id="select2" name="category_id">
                                    <option value="">انتخاب دسته</option>
                                    <?php foreach($menus as $dat){?>
                                    <option value="{{$dat->id}}">{{$dat->name}}</option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </form>

                <form class="form-horizontal" id="prospects_form">
                    {{csrf_field()}}
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="name-category"> دسته </label>
                            <div class="controls">
                                <div class="box span3   ">
                                    <div class=" box " style="width: fit-content">

                                        <div id="category">


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->



    <script src="{{asset('FRONTED/js/jquery.js')}}"></script>


    <script type='text/javascript'>
        $(document).ready(function () {
            $('#select2').on('change', function (e) {
                let _token = $('meta[name="csrf-token"]').attr('content');
                var menu_id = document.getElementById("select2").value;
                $.ajax({
                    url: "{{ route('submenu.fetch') }}",
                    type: "POST",
                    data: {
                        menu_id: menu_id,
                        _token: _token
                    },
                    success: function (response) {
                        // console.log(response);

                        var len = 0;
                        var color_status;
                        var color_recommended;
                        var name_recommended;
                        var name_status;
                        var act;
                        // $('#userTable tbody').empty(); // Empty <tbody>
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }

                        if (len > 0) {
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].Product_id;
                                var name = response['data'][i].Product_name;
                                // var image = response['data'][i].Product_image;
                                var image = response['data'][i].photo[0].imageable_path;
                                var category_name = response['data'][i].category.category_name;
                                var color_id = response['data'][i].color_id;
                                var manufacture_name = response['data'][i].brand.manufacture_name;
                                var size = response['data'][i].Product_size;
                                var price = response['data'][i].Product_price;
                                var long_description = response['data'][i].Product_long_description;
                                var short_description = response['data'][i].Product_short_description;
                                var status = response['data'][i].Product_status;
                                var recommended = response['data'][i].recommended;
                                // console.log(images);

                                if (recommended == 1) {
                                    color_recommended = "success";
                                    name_recommended = "Active";
                                }
                                else {
                                    color_recommended = "important";
                                    name_recommended = "Banned";

                                }

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
                            }
                        } else {
                            var tr_str = "<tr>" +
                                "<td align='center' colspan='4'>No record found.</td>" +
                                "</tr>";

                            $("#userTable tbody").append(tr_str);
                        }
                    },
                    error: function (respons) {
                        console.log('no');
                    }
                })
            });
            $(document.body).on("click", ".valids", deleteProduct);

            function deleteProduct() {

                let _token = $('meta[name="csrf-token"]').attr('content');
                let manufacture_id = 1;
                var cat_id = $(this).val();
                $.ajax({
                    url: "{{ route('category.manufacture.delete') }}",
                    type: "POST",
                    data: {
                        manufacture_id: manufacture_id,
                        cat_id: cat_id,
                        _token: _token
                    },
                    success: function (result) {
                        fetchcat();
                        fetch();
                    },
                });
                return false;
            }
        });

    </script>

@endsection