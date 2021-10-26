123

{{--{{dd($all)}}--}}
@php
//foreach ($all as $e){
 //return $e->;
//echo     $all;

//}

@endphp
@foreach ($all as $user)
    {{ $user->Product_name }}
@endforeach
{{ $all->links() }}
