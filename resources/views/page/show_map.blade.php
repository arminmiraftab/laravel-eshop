@extends('conent_left')
@section('content-panel')
    <div class="container dir_right ">
        <div class="row" style="    margin-top: 204px;
">
            <div class="row">
                @foreach($shop as $dat)
                    <div class="col-sm-6 m-5 ">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">ادرس</h5>
                                <p class="card-text">{{$dat->shipping_adderss_map}} پلاک: {{$dat->House_number}}
                                    واحد: {{$dat->shipping_unit}}    </p>
                                <h5 class="card-title">کدپستی </h5>
                                <p class="card-text">{{$dat->shipping_code_post}}</p>

                                <a href="{{URL::to('panel_user/delet_ship/'.$dat->shipping_id)}}"
                                   class="btn btn-primary">حذف</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
