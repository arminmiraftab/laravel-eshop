@extends('admin_panel')
@section('content')
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">خانه</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">اسلایدر</a>
        </li>
    </ul>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>اسلایدر</h2>
                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" id="slide_form" enctype="multipart/form-data">

                    {{csrf_field()}}
                    <div class="alert" id="message" style="display: none"></div>

                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="name-category">سر موضوع </label>
                            <div class="controls">
                                <input type="text" name="subcat" value="{{$value->sub_category_slider}}" required
                                       class="span6 typeahead" id="name_category" data-provide="typeahead"
                                       data-items="10"
                                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name-category">موضوع </label>
                            <div class="controls">
                                <input type="text" name="cat" value="{{$value->category_slider}}"
                                       class="span6 typeahead" id="name_category" data-provide="typeahead"
                                       data-items="10"
                                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name-category">توتضیحات </label>
                            <div class="controls">
                                <input type="text" name="write" value="{{$value->detal_slider}}" class="span6 typeahead"
                                       id="name_category" data-provide="typeahead" data-items="10"
                                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name-category">اسم کلید </label>
                            <div class="controls">
                                <input type="text" name="submit" value="{{$value->submit_slider}}" required
                                       class="span6 typeahead" id="name_category" data-provide="typeahead"
                                       data-items="10"
                                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name-category"> لینک </label>
                            <div class="controls">
                                <input type="text" name="submit_link" value="{{$value->submit_link}}" required
                                       class="span6 typeahead" id="name_category" data-provide="typeahead"
                                       data-items="10"
                                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="image">اپلود عکس</label>
                            <div class="controls">
                                <input class="input-file uniform_on" id="images" name="images" type="file">
                            </div>
                            @foreach($value->photo as $data)

                                <img src="{{URL::to($data->imageable_path)}}" style="width:80px;height:80px" alt="">

                            @endforeach
                        </div>

                        <div class="control-group">
                            <label class="control-label">حالت نمایش</label>
                            <div class="controls">
                                <label class="checkbox inline">
                                    <input type="checkbox" id="inlineCheckbox1" name="status" value="1">
                                </label>

                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                        <input type="hidden" name="id" value="{{$value->slider_id}}">

                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->
    <script src="{{asset('FRONTED/js/jquery.js')}}"></script>

    <script>

        $(document).ready(function () {

            $('#slide_form').on('submit', function (event) {
                event.preventDefault();

                var formData = new FormData(this);
                console.log(formData);
                $.ajax({
                    url: "{{ route('save.edit.slider') }}",
                    method: "POST",
                    data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        console.log(data);
                        $('#message').css('display', 'block');
                        $('#message').html(data.message);
                        $('#message').addClass(data.class_name);
                        $('#uploaded_image').html(data.uploaded_image);
                    }
                })
            });

        });

    </script>
@endsection