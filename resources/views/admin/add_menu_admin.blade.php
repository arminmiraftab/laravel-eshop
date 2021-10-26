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
            <a href="#">منو</a>
        </li>
    </ul>

    <div class="row-fluid sortable">
        <div class="col-lg-6">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon edit"></i><span class="break"></span> اضافه کردن زیر منو</h2>
                    <div class="box-icon">
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form class="form-horizontal" method="post" action="{{route('seve.sub')}}">
                        {{csrf_field()}}

                        <p class="alert-success text-center">
                            <?php
                            $message=Session::get('messagea');
                            if($message){
                                echo $message;
                                Session::put('messagea',null);
                            }
                            ?>
                        </p>
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="name-category">اسم منو</label>
                                <div class="controls">
                                    <input type="text" name="name_sub" class="span6 typeahead" id="name_category"  data-provide="typeahead" data-items="10" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                                    @if ($errors->has('name_sub'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name_sub') }}</strong>
                                    </span>
                                    @endif

                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="name-category">لینک </label>
                                <div class="controls">
                                    <input type="text" name="link_sub" class="span6 typeahead" id="name_category"  data-provide="typeahead" data-items="10" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>
                                    @if ($errors->has('link_sub'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link_sub') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="selectError2">انتخاب دسته</label>
                                <div class="controls">
                                    <select data-placeholder="انتخاب دسته" id="selectError2"  name="category_id">
                                        <option >انتخاب دسته</option>
                                        <?php foreach($all_table_category as $dat){?>
                                        <option value="{{$dat->id}}">{{$dat->name}}</option>
                                        <?php }?>

                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">ثبت</button>
                                <button type="reset" class="btn ">لغو</button>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div><!--/span-->
        </div>

        <div class="col-lg-6">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon edit"></i><span class="break"></span> اضافه منو </h2>
                    <div class="box-icon">
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form class="form-horizontal" method="post" action="{{route('seve.menu')}}">
                        {{csrf_field()}}
                        <p class="alert-success text-center">

                            <?php
                            $message=Session::get('message');
                            if($message){
                                echo $message;
                                Session::put('message',null);
                            }
                            ?>
                        </p>
                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="name-category">اسم منو</label>
                                <div class="controls">
                                    <input type="text" name="namemen" class="span6 typeahead" id="namemen"  data-provide="typeahead" data-items="10" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>

                                    @if ($errors->has('namemen'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('namemen') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="name-category">لینک </label>
                                <div class="controls">
                                    <input type="text" name="linkmen" class="span6 typeahead" id="namemen"  data-provide="typeahead" data-items="10" data-source='["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Dakota","North Carolina","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"]'>

                                    @if ($errors->has('linkmen'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('linkmen') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">ثبت</button>
                                <button type="reset" class="btn ">لغو</button>
                            </div>
                        </fieldset>
                    </form>

                </div>
            </div><!--/span-->
        </div>

    </div><!--/row-->




@endsection