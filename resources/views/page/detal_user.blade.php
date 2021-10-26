@extends('conent_left')
@section('content-panel')
    <div class="container mt-5">
        <div class="row mt-5 " id="modal">
            <table class="table table-bordered text-right mt-lg-5" id="information_user"
                   style="border:3px solid #e9ecef;margin-top: 120px">
                <tbody id="tbd">
                <tr>
                    <td> نام نام خانوادگی <br>{{$pho->name}} {{$pho->last_name}}</td>
                    <td>پست الکترونیک : <br>{{$pho->email}}</td>


                </tr>
                <tr>
                    <td>شماره تلفن همراه:<br>{{$pho->phone_number}}</td>
                    <td>کد ملی:<br>{{$pho->National_Code}}</td>

                </tr>

                </tbody>
            </table>
            <p class="alert-success text-center" id="message-success">

            </p>
            <p class="alert-danger text-center" id="message-danger">

            </p>

            <div class="col-sm-9 clearfix">
                <div class="bill-to">
                    <div class="form-one float-right  " style="float:right; margin-top: 150px">
                        <form id="prospects_form">
                            <div class="row">
                                {{csrf_field()}}
                                <div class="col-lg-6 col-sm-6">
                                    <input type="text" style="padding-right: 0;width:230px;text-align: center;"
                                           id="first_nam" placeholder="اسم  *" name="first_name" required
                                           data-error="لطفا فیلد را پر کنید">
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <input type="text" style="padding-right: 0; width:230px;text-align: center;"
                                           id="last_name" placeholder="*نام خانوادگی" name="last_name" required
                                           data-error="لطفا فیلد را پر کنید">
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <input type="email" class="pr-0" style="width:500px;text-align: center;" id="email"
                                       placeholder="*ایمیل" name="email" required data-error="لطفا فیلد را پر کنید">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                                <input type="text" style="width:500px;text-align: center;" id="mobail"
                                       placeholder="موبایل" pattern="[0-9]{7,15}" name="mobail" required
                                       data-error="لطفا فیلد رابافرمت عددی بین 7تا15 پر کنید">
                                @if ($errors->has('mobail'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobail') }}</strong>
                                    </span>
                                @endif
                                <input type="text" style="width:500px;text-align: center;" id="Code_nmber"
                                       placeholder="کد ملی" pattern="[0-9]{9,15}" name="Code_nmber" required
                                       data-error="لطفا فیلد رابافرمت عددی بین 8تا15 پر کنید">
                                @if ($errors->has('Code_nmber'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Code_nmber') }}</strong>
                                    </span>
                                @endif
                                <button class="btn btn-default "
                                        style="margin-bottom: 50px;padding: 6px 93px 6px 94px;float: right">ثبت
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            var inputs = document.getElementsByTagName("INPUT");
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].oninvalid = function (e) {
                    e.target.setCustomValidity("");
                    if (!e.target.validity.valid) {
                        e.target.setCustomValidity(e.target.getAttribute("data-error"));
                    }
                };
            }
        });


        $("#prospects_form").submit(function (e) {
            e.preventDefault();

            var Code_nmber = $('input[name=Code_nmber]').val();
            var mobail = $('input[name=mobail]').val();
            var first_name = $('input[name=first_name]').val();
            var last_name = $('input[name=last_name]').val();
            var email = $('input[name=email]').val();
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('user.save') }}",
                type: "POST",
                data: {
                    Code_nmber: Code_nmber,
                    mobail: mobail,
                    first_name: first_name,
                    last_name: last_name,
                    email: email,
                    _token: _token
                },
                success: function (response) {
                    var na = response;
                    if (response) {
                        var s = document.getElementById("first_nam").innerHTML = response.first_name;
                        document.getElementById("Code_nmber").innerHTML = response.Code_nmber;
                        document.getElementById("mobail").innerHTML = response.mobail;
                        document.getElementById("last_name").innerHTML = response.last_name;
                        document.getElementById("email").innerHTML = response.email;
                        console.log(s);
                        $("#tbd").remove();
                        $("#information_user ").prepend('<tbody id="tbd"><tr><td>  نام  نام خانوادگی <br>' + response.first_name + response.last_name + '</td><td> پست الکترونیک : <br>' + response.email + '</td></tr><tr><td> شماره تلفن همراه:<br>' + response.mobail + '</td><td> کد ملی:<br>' + response.Code_nmber + '</td></tr> </tbody>');
                        document.getElementById("prospects_form").reset();
                        document.getElementById("message-success").innerHTML = "انجام شد"
                    }
                },
                error: function (respons) {
                    document.getElementById("message-danger").innerHTML = "انجام نشد"
                }

            });
            console.log(product_id);
        });
    </script>

@endsection
