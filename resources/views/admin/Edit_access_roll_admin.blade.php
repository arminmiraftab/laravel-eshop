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
            <a href="{{url('admin/admin/add_roll')}}">کاربران سایت</a>
        </li>
    </ul>
    <ul class="noty_cont noty_layout_topRight notificati" id="#notificati">
    </ul>
    <div class="row-fluid">


        <div class="box span12">
            <div class="box-header">
                <h2><i class="halflings-icon list"></i><span class="break"></span>کاربران سایت</h2>
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

                    <form class="form-horizontal" method="POST" action="{{ route('Edite.rule.save.admin') }}"
                          id="register_form">

                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$db_user->id}}">

                        <fieldset style="margin-right: 8px;margin-left: 8px;">
                            <div class="control-group">
                                <label class="control-label" for="name_register">نام</label>

                                <div class="controls">
                                    <input type="text" value="{{$db_user->name}}"
                                           class="span6 typeahead {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           id="name" name="name" autofocus data-provide="typeahead">

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="selectError">انتخاب دسترسی </label>
                                <div class="controls">
                                    <select data-placeholder="انتخاب دسترسی " id="regroll" name="rule_id" required>
                                        <option selected="selected" hidden
                                                value="{{$db_user->roll['id']}}">{{$db_user->roll['name']}}</option>

                                        <?php foreach( $db_rule as $dat){?>

                                        <option value="{{$dat->id}}">{{$dat->name}}</option>
                                        <?php }?>
                                    </select>


                                </div>
                            </div>
                            <div id="lastname">

                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name_manufacture">ایمیل</label>
                                <div class="controls">
                                    <input type="email" value="{{$db_user->email}}" id="email"
                                           class="span6 typeahead {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" data-provide="typeahead" data-items="10">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name_manufacture"> تغییر پسورد</label>
                                <div class="controls">
                                    <input type="password"
                                           class="span6 typeahead{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" id="password" data-provide="typeahead" data-items="10">
                                    <i class="fa  fa-eye" style="margin-left: -30px;cursor: pointer;"
                                       id="togglePassword" aria-hidden="true"></i>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="control-group">
                                <label class="control-label" for="name_manufacture">تایید پسورد</label>
                                <div class="controls">
                                    <input id="password-confirm" type="password" placeholder="تایید پسورد"
                                           name="password_confirmation" class="span6 typeahead" data-provide="typeahead"
                                           data-items="10">

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