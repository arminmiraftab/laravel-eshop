@extends('admin_panel')
@section('content')


        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="index.html">Home</a>
                <i class="icon-angle-right"></i>
            </li>
            <li>
                <i class="icon-edit"></i>
                <a href="#">Forms</a>
            </li>
        </ul>

        <div class="row-fluid sortable">
            <div class="box span12">
                <div class="box-header" data-original-title>
                    <h2><i class="halflings-icon edit"></i><span class="break"></span> اضافه کردن دسته</h2>
                    <div class="box-icon">
                        <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                        <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                        <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <form class="form-horizontal" method="post" action="{{url('/admin/admin_category/EDITa_CATEGORY/'.$db_info->category_id)}}">
                        {{csrf_field()}}

                        <fieldset>
                            <div class="control-group">
                                <label class="control-label" for="name-category">اسم دسته</label>
                                <div class="controls">
                                    <input type="text" name="name_category" class="span6 typeahead" id="name_category" required value="{{$db_info->category_name}}">
                                    @if ($errors->has('name_category'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name_category') }}</strong>
                                    </span>
                                    @endif
                                 </div>
                            </div>
                            <div class="control-group hidden-phone">
                                <label class="control-label" for="description-category">توضیحات دسته</label>
                                <div class="controls">
                                    <textarea class="cleditor"  name="description_category" id="description_category" rows="3"  > {{$db_info->category_name}}</textarea>
                                    @if ($errors->has('description_category'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description_category') }}</strong>
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





@endsection