@extends('admin_panel')
@section('content')
    {{--/ <div id="content" class="span10">--}}


    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="{{url('admin/Dashboard')}}">خانه</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="{{url('admin/admin/add_roll')}}">دسترسی</a>
        </li>
    </ul>
    <ul class="noty_cont noty_layout_topRight notificati" id="#notificati">
    </ul>
    <div class="row-fluid">


        <div class="box span12">
            <div class="box-header">
                <h2><i class="halflings-icon list"></i><span class="break"></span>اضافه کردن کاربر</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content buttons">


                <div class="box span12">
                    <div id="user_register">
                        <p class="alert-success text-center" id="message-register-success">
                        </p>
                    </div>

                    <form class="form-horizontal" id="register_form">

                        {{csrf_field()}}


                        <fieldset style="margin-right: 8px;margin-left: 8px;">
                            <div class="control-group">
                                <label class="control-label" for="name_register">نام</label>

                                <div class="controls">
                                    <input type="text" id=""
                                           class="span6 typeahead {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           id="name" name="name" required autofocus data-provide="typeahead">

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="roll">سطح عملکرد </label>
                                <div class="controls">
                                    <select data-placeholder="انتخاب کاربر" id="regroll" name="roll">
                                        <option>انتخاب کاربر</option>
                                        <?php foreach($roll as $dat){?>
                                        <option value="{{$dat->id}}">{{$dat->name}}</option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                            <div id="lastname">
                                {{--<label class="control-label" for="last_name_register">نام خانوادگی</label><div class="controls"><input type="text" class="span6 typeahead" id="last_name_register" data-provide="typeahead" data-items="10" name="last_name" required autofocus>--}}

                            </div>

                            <div class="control-group">
                                <label class="control-label" for="name_manufacture">ایمیل</label>
                                <div class="controls">
                                    <input type="email" id="email"
                                           class="span6 typeahead {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           value="" name="email" required data-provide="typeahead" data-items="10">

                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name_manufacture">پسورد</label>
                                <div class="controls">
                                    <input type="password"
                                           class="span6 typeahead{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required id="password" data-provide="typeahead"
                                           data-items="10">
                                    <i class="fa  fa-eye" style="margin-left: -30px;cursor: pointer;"
                                       id="togglePassword" aria-hidden="true"></i></div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name_manufacture">تایید پسورد</label>
                                <div class="controls">
                                    <input id="password-confirm" type="password" placeholder="تایید پسورد"
                                           name="password_confirmation" class="span6 typeahead" required
                                           data-provide="typeahead" data-items="10">

                                </div>
                            </div>
                            <div class="form-actions">
                                <button id="registerss" class="btn btn-primary">ثبت</button>
                            </div>
                        </fieldset>
                    </form>

                </div>


            </div>
        </div><!--/span-->

    </div>



    </div>
    <script src="{{asset('FRONTED/js/jquery.js')}}"></script>

    <script>

        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye / eye slash icon
            this.classList.toggle('fa-eye-slash');
        });

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

        $("#prospects_form").submit(function (e) {
            e.preventDefault();
            let user = document.getElementById("user").value;
            let roll = document.getElementById("roll").value;
            let _token = $('meta[name="csrf-token"]').attr('content');
            // document.getElementById("#message-dangejksnkjr").innerHTML="";

            if (user != "" && roll != "") {
                console.log(user);
                $.ajax({
                    url: "{{ route('roll.seve') }}",
                    type: "POST",
                    data: {
                        roll: roll,
                        user: user,
                        _token: _token
                    },
                    success: function (response) {
                        if (response) {
                            console.log(response);
                            // $("#roll").reset();
                            document.getElementById("prospects_form").reset();
                            // document.getElementById("roll").reset();
                            // $('#message-danger').empty();


                            if (response.error) {
                                document.getElementById("prospects_form").reset();
                                notif(response.error);
                            } else {
                                document.getElementById("prospects_form").reset();
                                notif(response.success, 'success');
                            }
                        }
                    },
                    error: function (respons) {
                        console.log(respons);
                        document.getElementById("message-danger").innerHTML = respons.error
                    }
                });
            }
        });

        $("#register_form").submit(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('regi') }}",
                type: "POST",
                data: $('#register_form').serialize(),
                dataType: 'JSON',
                success: function (response) {
                    if (response) {

                        if (response.success) {
                            console.log(response.success);
                            notif(response.success, 'success');

                            document.getElementById("register_form").reset();

                        }
                        if (response.error) {
                            $('#user_register').empty(); // Empty <tbody>

                            console.log(response.error);
                            // for(var j;)
                            if (response.error.name) {
                                notif(response.error.name);
                            }
                            if (response.error.last_name) {
                                notif(response.error.last_name);

                            }
                            if (response.error.email) {
                                notif(response.error.email);
                            }
                            if (response.error.password) {
                                notif(response.error.password);

                            }

                        }

                    }

                },
            });
        });
        $(document).ready(function () {
            $('#regroll').on('change',function(e) {
                // let _token = $('meta[name="csrf-token"]').attr('content');
                var cat_id =  e.target.value;
                if(cat_id==1) {
                    $('#lastname').empty();

                    $('#lastname').append('<div class="control-group"><label class="control-label" for="last_name_register">نام خانوادگی</label><div class="controls"><input type="text" class="span6 typeahead" id="last_name_register" data-provide="typeahead" data-items="10" name="last_name" required autofocus> </div></div>');
                }else {
                    $('#lastname').empty();

                }
                // $.ajax({
                //
                //     success:function (data) {
                //         // console.log(data);
                //         if(data){
                //             $('#selectError').empty();
                //             $.each(data, function(key, value){
                //             });
                //         }
                //
                //
                //     },
                //     error: function(respons){
                //
                //         console.log('no');
                //     }
                // })
            });

        });


    </script>

@endsection