<div class="col-sm-3 col-lg-3">
    <div class="left-sidebar">

        <h2>رنگ</h2>

        <div class="panel-group category-products" id="accordian"><!--category-productsr-->

            @if(count($all_table_color))
                @foreach($all_table_color as $dat)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                    @php
                                        $ch=[];
                                        if (isset($_GET['barnd']))
                                            $ch=$_GET['barnd'];
                                    @endphp

                                    <div class = "uk-inline">
                                        <input type = "checkbox" class = "" name = "barnd[]" value = "{{$dat->color_id}}"  @if((in_array(1,$ch)))checked @endif />
                                        <label style="color: #1b1e21;" class="" for = "{{$dat->color_id}}"> {{$dat->color_name}}</label>
                                    </div>


                                <a href="{{URL::to('product/product_by_color/'.$dat->color_id)}}">
                                    {{$dat->color_name}}
                                </a>
                            </h4>
                        </div>
                    </div>
                @endforeach
            @endif



        </div><!--/category-products-->

        <div class="brands_products"><!--brands_products-->
            <h2>برند</h2>
            <div class="brands-name">
                <form action="{{\Illuminate\Support\Facades\URL::current()}}" method="get">
                    {{--@php--}}
                                    {{--$ch1=$_GET['product'];--}}
                    {{--echo $ch1;--}}
                    {{--@endphp--}}
                    @php
                        $c2=[];
                        if (isset($_GET['product']))
                            $c2=$_GET['product'];
                    @endphp
                    <input type="hidden" name="product" value="{{$_GET['product']}}">
{{--{{ddd($all_table_category)}}--}}
                @if(count($all_table_category))
                    @foreach($all_table_category->flatMap->brands->unique('manufacture_id')  as $dat)
                        @php
                            $ch=[];
                            if (isset($_GET['brand']))
                                $ch=$_GET['brand'];
                        @endphp

                        <div class = "uk-inline">
                            <input type = "checkbox" class = "" name = "brand[]" value = "{{$dat->manufacture_id}}"  @if((in_array($dat->manufacture_id,$ch)))checked @endif />
                            <label style="color: #1b1e21;" class="" for = "{{$dat->manufacture_id}}"> {{$dat->manufacture_name}}</label>
                        </div>
                            @endforeach
                            @endif
                            <button type="submit">
                                filter
                            </button>
                </form>
            </div>

        </div><!--/brands_products-->

        <div class="shipping text-center"><!--shipping-->
            <img src="{{asset('FRONTED/images/home/shipping.jpg')}}" alt="" />
        </div><!--/shipping-->

    </div>
</div>