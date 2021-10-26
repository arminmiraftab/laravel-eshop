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
                    <ul class="noty_cont noty_layout_topRight notificati" id="#notificati">
                    </ul>
                    <div class="alert" id="message" style="display: none"></div>

                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="name-category">سر موضوع </label>
                            <div class="controls">
                                <input type="text" name="subcat" required class="span6 typeahead" id="name_category"
                                       data-provide="typeahead" data-items="10"
                                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                                @if ($errors->has('subcat'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subcat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name-category">موضوع </label>
                            <div class="controls">
                                <input type="text" name="cat" class="span6 typeahead" id="name_category"
                                       data-provide="typeahead" data-items="10"
                                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                                @if ($errors->has('cat'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cat') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name-category">توتضیحات </label>
                            <div class="controls">
                                <input type="text" name="write" class="span6 typeahead" id="name_category"
                                       data-provide="typeahead" data-items="10"
                                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                                @if ($errors->has('write'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('write') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name-category">اسم کلید </label>
                            <div class="controls">
                                <input type="text" name="submit" required class="span6 typeahead" id="name_category"
                                       data-provide="typeahead" data-items="10"
                                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                                @if ($errors->has('submit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('submit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name-category"> لینک </label>
                            <div class="controls">
                                <input type="text" name="submit_link" required class="span6 typeahead"
                                       id="name_category" data-provide="typeahead" data-items="10"
                                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                                @if ($errors->has('submit_link'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('submit_link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name-category"> alt </label>
                            <div class="controls">
                                <input type="text" name="alt" required class="span6 typeahead" id="alt"
                                       data-provide="typeahead" data-items="10"
                                       data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                                @if ($errors->has('alt'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('alt') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="image">اپلود عکس</label>
                            <div class="controls">
                                <input class="input-file uniform_on" id="images_slide" name="images_slide" type="file">
                                @if ($errors->has('images_slide'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('images_slide') }}</strong>
                                    </span>
                                @endif
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

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            <button type="reset" class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->
    <script src="{{asset('FRONTED/js/jquery.js')}}"></script>

    <script>
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

        $(document).ready(function () {

            $('#slide_form').on('submit', function (event) {
                event.preventDefault();

                var formData = new FormData(this);
                console.log(formData);
                $.ajax({
                    url: "{{ route('save.slider') }}",
                    method: "POST",
                    data: formData,
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        if (response.error) {
                            if (response.error.images_slide) {
                                notif(response.error.images_slide);

                            }
                            if (response.error.subcat) {
                                notif(response.error.subcat);

                            }
                            if (response.error.cat) {
                                notif(response.error.cat);

                            }
                            if (response.error.write) {
                                notif(response.error.write);

                            }
                            if (response.error.submit) {
                                notif(response.error.submit);

                            }
                            if (response.error.submit_link) {
                                notif(response.error.submit_link);

                            }


                        }
                        if (response.success) {
                            document.getElementById("slide_form").reset();
                            notif(response.success, 'success')


                            ;
                        }
                    }
                })
            });

        });

    </script>
@endsection