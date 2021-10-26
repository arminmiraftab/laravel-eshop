@extends('admin_panel')
@section('content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('/Dashboard')}}">خانه</a>
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
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" id="prospects_form"  enctype="multipart/form-data">

                    {{csrf_field()}}
                    <ul class="noty_cont noty_layout_topRight notificati" id="#notificati" >
                    </ul>
                    <p class="alert  text-center" style="display: none"id="message">

                    </p>
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="typeahead">اسم محصول </label>
                            <div class="controls">
                                <input type="text" class="span6 typeahead" name="name_Product"  id="typeahead"  data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                            </div>

                        </div>

                        <div class="control-group">
                            <label class="control-label" for="selectError3">رنگ</label>
                            <div class="controls">
                                <select data-placeholder="انتخاب دسته" id="selectError3"  name="color_id">
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
                                <select data-placeholder="انتخاب دسته" id="selectError2"   name="category_id">
                                    <option value="" >انتخاب دسته</option>
                                    <?php foreach($all_table_category as $dat){?>
                                    <option value="{{$dat->category_id}}">{{$dat->category_name}}</option>
                                    <?php }?>

                                </select>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="selectError">انتخاب برند</label>
                            <div class="controls">
                                <select data-placeholder="انتخاب برند"  id="selectError"   name="manufacture_id">
                                    <option  >انتخاب برند</option>


                                </select>
                            </div>
                        </div>



                        <div class="control-group hidden-phone">
                            <label class="control-label" for="short">توضیحات کوتاه</label>
                            <div class="controls">
                                <textarea class="cleditor description" id="short" name="short_description_Product" rows="3" ></textarea>
                            </div>
                        </div>
                        <div class="control-group hidden-phone">
                            <label class="control-label" for="long">توضیحات بلند</label>
                            <div class="controls">
                                <textarea class="cleditor description" id="long" name="long_description_Product" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="price">قیمت </label>
                            <div class="controls">
                                <input type="text" pattern="[0-9]{0,15}"  class="span6 typeahead" id="price" name="price_Product" data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                            </div>

                        </div>
                        <div id="image_Producted"></div>
                        <input class="" TYPE="hidden" id="image_Product"  name="image_Product" value="" >


                        <div class="control-group">
                            <label class="control-label" for="size">alt عکس </label>
                            <div class="controls">
                                <input type="text" class="span6 typeahead" id="size"   name="alt" data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                            </div>
                        </div>
                       
                        <div class="control-group">
                            <label class="control-label" for="size">سایز محصول </label>
                            <div class="controls">
                                <input type="text" class="span6 typeahead" id="size"   name="size_Product" data-provide="typeahead" data-items="4" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
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
                            <label class="control-label">توصیه شده ها</label>
                            <div class="controls">
                                <label class="checkbox inline">
                                    <input type="checkbox" id="inlineCheckbox2" name="recame" value="1">
                                </label>



                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls" id="images">
                            </div>
                        </div>
                    </fieldset>
                </form>
                <form class="form-horizontal" id="image_form"  enctype="multipart/form-data">

                    {{csrf_field()}}
                    <ul class="noty_cont noty_layout_topRight notificati" id="#notificati" >
                    </ul>
                    <p class="alert  text-center" style="display: none"id="message">

                    </p>
                    <fieldset>

                        <div class="control-group">
                            <label class="control-label" for="image">اپلود عکس</label>
                            <div class="controls">
                                     <input class=""  id="image_Products"  name="image_Product[]"  type="file" MULTIPLE>
                                     <button class="btn" form="image_form" >upload</button>
                            </div>
                        </div>
                    </fieldset>
                </form>

                <div class="form-actions">
                    <button type="submit" form="prospects_form"  class="btn btn-primary">Save changes</button>
                </div>
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

        $(document).ready(function(){

            $('#prospects_form').on('submit', function(event){
                event.preventDefault();

                var formData = new FormData(this);
                // console.log(formData);
                $.ajax({
                    url:"{{ route('save.Product') }}",
                    method:"POST",
                    data:formData,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(response)
                    {
                        console.log(response);
                        if (response.error){
                            if (response.error.name_Product){
                                notif(response.error.name_Product);

                            }if (response.error.image_Product){
                                notif(response.error.image_Product);

                            }
                            if (response.error.short_description_Product){
                                notif(response.error.short_description_Product);

                            }  if (response.error.long_description_Product){
                                notif(response.error.long_description_Product);

                            }
                            if (response.error.manufacture_id){
                                notif(response.error.manufacture_id);

                            } if (response.error.price_Product){
                                notif(response.error.price_Product);

                            }
                            if (response.error.category_id){
                                notif(response.error.category_id);
                            }
                            if (response.error.color_id){
                                notif(response.error.color_id);
                            }
                            if (response.error.size_Product){
                                notif(response.error.size_Product);
                            }   if (response.error.optionsRadios){
                                notif(response.error.optionsRadios);
                            }

                        }
                        if (response.success) {
                            $("#images").empty();

                            document.getElementById("prospects_form").reset();
                            $(".description").val('').blur();
                            $('#select2 option:not(:first)').remove();

                            // document.getElementById("image_Product").value = "";
                            notif(response.success,'success');

                            }
                    }
                })
            });

        });



        function previewMultiple(event){
            var saida = document.getElementById("adicionafoto");
            var quantos = saida.files.length;
            for(i = 0; i < quantos; i++){
                var urls = URL.createObjectURL(event.target.files[i]);
                document.getElementById("galeria").innerHTML +=
                    '<label class="radio radio-img"><input type="radio"  style="visibility: hidden;" class="radio" name="optionsRadios" id="optionsRadios2" value=""><img  src="'+urls+'"> </label> ';
            }
        }


        $(document).ready(function(){
            // console.log( window.location.origin);
            const data = new Array();
            const ids =0;

            $('#image_form').on('submit', function(event){
                event.preventDefault();

                var formData = new FormData(this);
                // console.log(formData);
                $.ajax({
                    url:"{{ route('save.image') }}",
                    method:"POST",
                    data:formData,
                    dataType:'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(response)
                    {
                        if(response){
                            $('#image_Products').val('') ;
                            // $('#image_Product').empty();
                            $.each(response.image, function(key, value){

                                data.push(key);
                                document.getElementById("image_Product").setAttribute("value",data);
                                var tr_str =
                           ' <label class="radio"><input checked type="radio" style="visibility: hidden;" class="radio" name="optionsRadios" id="optionsRadios2" value="'+key+'">'+
                           '<div id="imageable"><button id="delet" form="image_form" class="delet btn btn-xs btn-link" value="'+key+'"><i class="halflings-icon remove"></i></button>'+
                           '<img src="'+window.location.origin+'/' +value+'" style="width:80px;height:80px" alt=""> </div> </label>';
                            $("#images").append(tr_str);
                            });
                        }


                        if (response.error){

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
                    url:"{{ route('delete.Product.image') }}",
                    type:"POST",
                    data: {
                        id:id ,
                        _token: _token
                    },
                    success: function(result) {

                        var id = $(this).val();
                        $(this).parent().parent().hide();
                        // console.log(result);

                    },
                })}
        });
        $(document).ready(function () {
            $('#selectError2').on('change',function(e) {
                let _token = $('meta[name="csrf-token"]').attr('content');
                var cat_id =  e.target.value;

                $.ajax({
                    url:"{{ route('manufacture.category') }}",
                    type:"POST",


                    data: {
                        cat_id: cat_id,
                        _token: _token
                    },
                    success:function (data) {
                     // console.log(data);
                        if(data){
                            $('#selectError').empty();
                            $.each(data, function(key, value){
                                $('select[name="manufacture_id"]').append('<option value="'+ key +'">' + value+ '</option>');
                            });
                        }


                    },
                    error: function(respons){

                        console.log('no');
                    }
                })
            });

        });


    </script>
@endsection