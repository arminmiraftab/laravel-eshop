<?php

//echo $user->roles;
//foreach($user->roles as $role) {
//    echo $role->name;
//}

//echo url()->current();
//echo url()->previous();
//dd($url);

//foreach($user as $us){
//    echo $us->name;
echo $j;
//}
?>
<form action="{{\Illuminate\Support\Facades\URL::Current()}}/" method="get">

    @php
        $ch=[];
        if (isset($_GET['act']))
            $ch=$_GET['act'];
    @endphp
    {{--<div><!---->--}}
        {{--<input type="checkbox" name="act[]" value="1" @if((in_array(1,$ch)))@endif>name1--}}


        {{--<input type="checkbox" name="act[]" value="2"{{request () ->act ? '': 'checked'}}>name2--}}
        {{--<input type="checkbox" name="act[]" value="3"{{request () ->act ? '': 'checked'}}>name3--}}


{{--</div>--}}
    <div class = "uk-inline">
        <input type = "checkbox" class = "uk-checkbox" name = "act[]" value = "{{1}}"  @if((in_array(1,$ch)))checked @endif />
        <label for = "{{1}}"> {{'name1'}} </label>
        <input type = "checkbox" class = "uk-checkbox" name = "act[]" value = "{{2}}"  @if((in_array(2,$ch)))checked @endif />
        <label for = "{{2}}"> {{'name2'}} </label>
    </div>
    <button type="submit">
        filter
    </button>

</form>