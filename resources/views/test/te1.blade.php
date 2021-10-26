<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $i=1;

                foreach($show_rec ->chunk(3) as $dat)
            {

//                            echo $dat;
            if ($i==1){
            ?>
            <div class="item active">
                <?php }else{?>
                <div class="item">
                    <?php }?>
                        <div class="col-sm-4">

                        <?php
                    $i=1;
                    $U=1;
                    foreach($dat as $data1){

//                    echo $data1;

                    ?>
                    @foreach($data1->photo as $data)
                        {{$data}}
                        @if($data->first_photo)

                            {{--                        @if($data->first_photo)--}}
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            {{asset($data->imageable_path)}}
{{--                                            <img src="{{asset($data->imageable_path)}}" alt="" width="20px" height="200px"/>--}}
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{--@endif--}}
                        @endif
                    @endforeach
                    <?php $U++; }?>
                </div>
                <?php $i++; }?>

            </div>
            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>
    </div><!--/recommended_items-->

</div>
