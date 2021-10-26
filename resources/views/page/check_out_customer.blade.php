@extends('layout')
@section('content-right')


    <div class="container">
        <div class="row">

    <p class="alert-success text-center">
        <?php
        $message=Session::get('message');
        if($message){
            echo $message;
            Session::put('message',null);
        }
        ?>
    </p>


<div class="col-sm-9 col-lg-9 clearfix " style=>
    <div class="bill-to">
        <p>Bill To</p>
        <div class="form-one">
            <form action="{{url('set_shipp')}}" method="post">
                {{csrf_field()}}
                <input type="text" placeholder="*ایمیل" name="email">
                <input type="text" placeholder="اسم کوچیک *" name="first">
                <input type="text" placeholder="موبایل" name="mobail">
                <input type="text" placeholder="نام خانوادگی*"name="last">
                <input type="text" placeholder="ادرس1 *"name="adderss">
                <input type="text" placeholder="شهر"name="city">
                <button class="btn btn-default">ثبت</button>
            </form>
        </div>

    </div>
</div>
    </div>
    </div>

@endsection