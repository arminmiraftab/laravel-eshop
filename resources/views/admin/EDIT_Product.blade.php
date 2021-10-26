@php


        @endphp
@extends('admin_panel')
@section('content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('/admin/Dashboard')}}">خانه</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">محصولات</a>
        </li>
    </ul>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>محصولات</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post" id="prospects_form"
                      action="{{url('/admin/admin_Product/EDIT_Product/'.$db_info->Product_id)}}"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">اسم محصول </label>
                            <div class="controls">
                                {{--<!----><input type="text" name="name_category" class="span6 typeahead" id="name_category"  value="{{$db_info->manufacture_name}}">--}}
                                <input type="text" class="span6 typeahead" name="name_Product" id="typeahead"
                                       value="{{$db_info->Product_name}}" data-provide="typeahead" data-items="4"
                                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>

                            </div>

                        </div>

                        <div class="control-group">
                            <label class="control-label" for="selectError3">رنگ</label>
                            <div class="controls">
                                <select data-placeholder="انتخاب دسته" id="selectError3" name="color_id">
                                    <option value="">انتخاب رنگ</option>
                                    <?php foreach($all_table_color as $dat){?>
                                    <option value="{{$dat->color_id}}">{{$dat->color_name}}</option>
                                    <?php }?>

                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError2">انتخاب دسته</label>
                            <div class="controls">
                                <select data-placeholder="انتخاب دسته" id="selectError2" name="category_id">
                                    <option value="{{$db_info->category->category_id}}">{{$db_info->category->category_name}}</option>
                                    <?php foreach($all_table_category as $dat){?>
                                    <option value="{{$dat->category_id}}">{{$dat->category_name}}</option>
                                    <?php }?>

                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError">انتخاب برند</label>
                            <div class="controls">
                                <select data-placeholder="انتخاب برند" id="selectError" name="manufacture_id">
                                    <option value="{{$db_info->brand->manufacture_id}}">{{$db_info->brand->manufacture_name}}</option>

                                </select>
                            </div>
                        </div>


                        <div class="control-group hidden-phone">
                            <label class="control-label" for="short">توضیحات کوتاه</label>
                            <div class="controls">
                                <textarea class="cleditor" id="short" name="short_description_Product"
                                          rows="3">{{$db_info->Product_short_description}}</textarea>
                            </div>
                        </div>
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="long">توضیحات بلند</label>
                            <div class="controls">
                                <textarea class="cleditor" id="long" name="long_description_Product"
                                          rows="3">{{$db_info->Product_long_description}} </textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="price">قیمت </label>
                            <div class="controls">
                                <input type="text" class="span6 typeahead" id="price" name="price_Product"
                                       data-provide="typeahead" value="{{$db_info->Product_price}}" data-items="4"
                                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                            </div>

                        </div>

                        <div class="control-group">
                            <label class="control-label" for="size">سایز محصول </label>
                            <div class="controls">
                                <input type="text" class="span6 typeahead" id="size" value="{{$db_info->Product_size}}"
                                       name="size_Product" data-provide="typeahead" data-items="4"
                                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                            </div>

                        </div>
                        <div class="control-group">
                            <label class="control-label">حالت نمایش</label>
                            <div class="controls">
                                <label class="checkbox inline">
                                    <input type="checkbox" id="inlineCheckbox1" name="status" value="1">
                                </label>

                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">توصیه شده</label>
                            <div class="controls">
                                <label class="checkbox inline">
                                    <input type="checkbox" id="inlineCheckbox1" name="recame" value="1">
                                </label>

                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <div class="delete-images">
                                    @foreach($db_info->photo as $dat)
                                        <a class="deleteimages deletds" onclick="deleteimg({{$dat->id}})" id="{{$dat->id}}">
                                            <i class="halflings-icon remove"></i>
                                        <img src="{{URL::to($dat->imageable_path)}}" style="width:80px;height:80px"
                                             alt="">
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </fieldset>
                </form>
                <form class="form-horizontal" id="image_form" enctype="multipart/form-data">

                    {{csrf_field()}}
                    <input class="" TYPE="hidden" id="image_Product" name="Product_id"
                           value="{{$db_info->Product_id }}">

                    <ul class="noty_cont noty_layout_topRight notificati" id="#notificati">
                    </ul>
                    <p class="alert  text-center" style="display: none" id="message">

                    </p>
                    <fieldset>

                        <div class="control-group">
                            <label class="control-label" for="image">اپلود عکس</label>
                            <div class="controls">
                                <input class="" id="image_Products" name="image_Product[]" type="file" MULTIPLE>
                                <button class="btn" form="image_form">upload</button>

                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls" id="images">
                            </div>
                        </div>

                    </fieldset>
                </form>

                <div class="form-actions">
                    {{--<button type="submit" onclick="myFunction()"  class="btn btn-primary">Save changes</button>--}}
                    <button type="submit" form="prospects_form" class="btn btn-primary">Save changes</button>
                    {{--<button type="reset" class="btn">Cancel</button>--}}
                </div>
            </div>
        </div><!--/span-->

    </div><!--/row-->
    <script src="{{asset('FRONTED/js/jquery.js')}}"></script>
    <script>
        $(document).ready(function () {

            $('#selectError2').on('change', function (e) {
                let _token = $('meta[name="csrf-token"]').attr('content');
                var cat_id = e.target.value;
                // console.log(cat_id);
                $.ajax({
                    url: "{{ route('manufacture.category') }}",
                    type: "POST",
                    data: {
                        cat_id: cat_id,
                        _token: _token
                    },
                    success: function (data) {
                        // console.log(data);
                        if (data) {
                            $('#selectError').empty();
                            $.each(data, function (key, value) {

                                $('select[name="manufacture_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    },
                    error: function (respons) {
                        console.log('no');
                    }
                })
            });
        });
        $(document).ready(function () {
            // console.log( window.location.origin);
            const data = new Array();
            var id = 0;

            $('#image_form').on('submit', function (event) {
                event.preventDefault();

                var formData = new FormData(this);
                var id = 1;
                // console.log(formData);
                $.ajax({
                    url: "{{ route('save.image.product') }}",
                    method: "POST",
                    data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        if (response) {
                            $('#image_Products').val('');
                            $.each(response.image, function (key, value) {
                                data.push(key);
                                var tr_str =
                                    ' <label class="radio"><input checked type="radio" style="visibility: hidden;" class="radio" name="optionsRadios" id="optionsRadios2" value="'+key+'">'+
                                    '<div id="imageable"><button id="delet" form="image_form" class="delet btn btn-xs btn-link" value="'+key+'"><i class="halflings-icon remove"></i></button>'+
                                    '<img src="'+window.location.origin+'/' +value+'" style="width:80px;height:80px" alt=""> </div> </label>';
                                $("#images").append(tr_str);
                            });
                        }

                        if (response.error) {

                        }
                        if (response.success) {


                        }

                    }
                })
            });

            $("div").on("click", ".delet", deleteProduct);

            function deleteProduct() {
                let _token = $('meta[name="csrf-token"]').attr('content');

                var id = $(this).val();
                $(this).parent().parent().empty();
                // console.log(id);

                $.ajax({
                    url: "{{ route('delete.Product.image') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function (result) {

                        var id = $(this).val();
                    },
                })
            }

            // $("div").on("click", ".deletds", deleteimg);


        });
        function deleteimg(id) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            // var id = $(this).attr('id');
            console.log(id);
            // $("#id").empty();
            document.getElementById(id).innerHTML = "";
            // $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('delete.Product.image') }}",
                type: "POST",
                data: {
                    id:id ,
                    _token: _token
                },
                success: function (result) {

                    console.log(result);
                    //
                },
            })
        }

    </script>

@endsection