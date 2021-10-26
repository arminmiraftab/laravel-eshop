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
                    <form class="form-horizontal" id="prospects_form">
                        {{csrf_field()}}
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="name-category">  دسته </label>
                                <div class="controls" >
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

                    <form class="form-horizontal" method="post" action="{{url('/admin/admin_manufacture/EDIT_manufacture/'.$db_info->manufacture_id)}}">
                        {{csrf_field()}}

                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="name-category">اسم برند</label>
                                <div class="controls">
                                    <input type="text" name="name_manufacture" class="span6 typeahead" id="name_manufacture" required  value="{{$db_info->manufacture_name}}">

                                    @if ($errors->has('name_category'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                        <strong class="text-danger">{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--<div class="control-group controls " >--}}
                                {{--<div class="controls" style="border: 1px solid;" >--}}
                                {{--</div>--}}
                            {{--</div>--}}




                            <div class="control-group">
                                <label class="control-label" for="selectError2">انتخاب دسته</label>
                                <div class="controls">
                                    <select data-placeholder="انتخاب دسته" id="select2"   name="category_id">
                                        <option value="">انتخاب دسته</option>

                                        {{--<?php foreach($brand as $dat){?>--}}
                                        {{--<option id="" value=""></option>--}}
                                        {{--<?php }?>--}}

                                    </select>
                                </div>
                            </div>

                            <div class="control-group hidden-phone">
                                <label class="control-label" for="description-category">توضیحات برند</label>
                                <div class="controls">
                                    <textarea class="cleditor"  name="description_manufacture" id="description_manufacture" rows="3"  > {{$db_info->manufacture_name}}</textarea>

                                    @if ($errors->has('description_category'))
                                        <span class="invalid-feedback text-danger" role="alert">
                                        <strong class="text-danger">{{ $errors->first('description_category') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">

                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">ثبت</button>
                                <button type="reset" class="btn">لغو</button>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div><!--/span-->

        </div><!--/row-->



    <script src="{{asset('FRONTED/js/jquery.js')}}"></script>


    <script type='text/javascript'>
        $(document).ready(function () {

        fetchcat();
            fetch();
            function fetch() {
                let manufacture_id = "{{$db_info->manufacture_id}}";
                let _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: "{{ route('EDIT.manufacture.fetchs') }}",
                    type: 'post',
                    data: {

                        id: manufacture_id,
                        _token: _token
                    },
                    dataType: 'json',
                    success: function (response) {
                        var len = 0;
                        $('#select2 option:not(:first)').remove();
                        if (response['data'] != null) {
                            len = response['data'].length;
                        }
                        if (len > 0) {
                            for (var i = 0; i < len; i++) {
                                var id = response['data'][i].category_id;
                                var name = response['data'][i].category_name;
                                var tr_str =
                                    '<option id="'+id+'" value="'+id+'">'+name+'</option> >';

                                $("#select2").append(tr_str);
                            }
                        } else {
                            var tr_str = "<tr>" +
                                "<td align='center' colspan='4'>No record found.</td>" +
                                "</tr>";
                        }

                    }
                });
            }
                function fetchcat() {
                    let manufacture_id = "{{$db_info->manufacture_id}}";
                    let _token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "{{ route('EDIT.manufacture.fetch') }}",
                        type: 'post',
                        data: {

                            id: manufacture_id,
                            _token: _token
                        },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            var len = 0;
                            $('#category').empty(); // Empty <tbody>
                            if (response['data'] != null) {
                                len = response['data'].length;
                            }

                            if (len > 0) {
                                for (var i = 0; i < len; i++) {
                                    var id = response['data'][i].category_id;
                                    var name = response['data'][i].category.category_name;
                                    var tr_str =
                                        '<button class="valids" VALUE=' + id + '>' + name +
                                        ' <i class="halflings-icon remove"></i></button>';

                                    $("#category").append(tr_str);
                                }
                            } else {
                                var tr_str = "<tr>" +
                                    "<td align='center' colspan='4'>No record found.</td>" +
                                    "</tr>";

                                $("#category").append(tr_str);
                            }
                        }
                      });
                }

            $('#select2').on('change',function(e) {
                let _token = $('meta[name="csrf-token"]').attr('content');
                var cat_id =  e.target.value;
                let manufacture_id = "{{$db_info->manufacture_id}}";
                $.ajax({
                    url:"{{ route('category.manufacture.fetch') }}",
                    type:"POST",
                    data: {
                        cat_id: cat_id,
                        manufacture_id: manufacture_id,
                        _token: _token
                    },
                    success:function (data) {
                        if(data){
                            fetch();
                            fetchcat();
                        }
                    },
                    error: function(respons){
                        console.log('no');
                    }
                })
            });
        $(document.body).on("click", ".valids", deleteProduct);

        function deleteProduct() {

            let _token = $('meta[name="csrf-token"]').attr('content');
            let manufacture_id = "{{$db_info->manufacture_id}}";
            var cat_id = $(this).val();
            $.ajax({
                url:"{{ route('category.manufacture.delete') }}",
                type:"POST",
                data: {
                    manufacture_id:manufacture_id ,
                    cat_id:cat_id ,
                    _token: _token
                },
                success: function(result) {
                    fetchcat();
                    fetch();
                },
            });
            return false;
        }
        });

    </script>

@endsection