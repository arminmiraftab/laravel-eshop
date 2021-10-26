@extends('admin_panel')
@section('content')
    <div>
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="{{url('/admin/Dashboard')}}">خانه</a>
        </ul>
        <div class="row-fluid">

            <a class="quick-button metro yellow span2">
                <i class="icon-group"></i>
                <p>Users</p>
                <span class="badge">{{$customer}}</span>
            </a>
            <a class="quick-button metro red span2">
                <i class="icon-comments-alt"></i>
                <p>Comments</p>
                <span class="badge">46</span>
            </a>

            <a class="quick-button metro blue span2" href="{{url('/admin/show_Product')}}">
                <i class="icon-shopping-cart"></i>
                <p>Orders</p>
                <span class="badge">{{$order}}</span>
            </a>
            <a class="quick-button metro green span2" href="{{url('/admin/manage_order')}}">
                <i class="icon-barcode"></i>
                <p>Products</p>
                <span class="badge">{{$products}}</span>
            </a>


            <div class="clearfix"></div>
            <div class="row-fluid pt-5">
            </div>

        </div><!--/row-->
        <div class="row-fluid">

            <div class="widget span6" onTablet="span6" onDesktop="span6">
                <h2><span class="glyphicons twitter"><i></i></span>فروش ماهانه</h2>
                <hr>
                <div class="content ">
                    <canvas id="myChart" style="height:300px"></canvas>
                </div>
                {{--<form id="select_time">--}}
                    {{--<p class="graphControls center">--}}
                        {{--<input onclick="fetchtime()" class="btn-primary inputs" name="inputs" id="inputs" type="button"--}}
                               {{--value="Bars">--}}
                        {{--<input class="btn-primary" type="button" value="Lines">--}}
                        {{--<input class="btn-primary" type="button" value="Lines with steps">--}}
                    {{--</p>--}}
                {{--</form>--}}
            </div><!--/span-->

            <div class="widget span6" onTablet="span6" onDesktop="span6">
                <h2><span class="glyphicons twitter"><i></i></span>فروش روانه</h2>
                <hr>
                <div class="content ">
                    <canvas id="day" style="height:300px"></canvas>
                </div>
            </div><!--/span-->

        </div>
        <div class="row-fluid">

            <div class="widget span3 red mt-lg-5" style="margin-top: 20px" onTablet="span6" onDesktop="span6">

                <h2><span class="glyphicons pie_chart"><i></i></span> Browsers</h2>

                <hr>

                <div class="content">

                    <div class="browserStat big">
                        <img src="{{asset('backend/img/Dashboard/browser-chrome-big.png')}}" alt="Chrome">
                        <span>{{$Chromes}}%</span>
                    </div>
                    <div class="browserStat big">
                        <img src="{{asset('backend/img/Dashboard/browser-firefox-big.png')}}" alt="Firefox">
                        <span>{{$Firefoxs}}%</span>
                    </div>
                    <div class="browserStat ">
                        <img src="{{asset('backend/img/Dashboard/browser-ie.png')}}" alt="Internet Explorer">
                        <span>{{$Firefoxs}}%</span>
                    </div>
                    <div class="browserStat">
                        <img src="{{asset('backend/img/Dashboard/browser-opera.png')}}" alt="Safari">
                        <span>{{$Safaries}}%</span>
                    </div>
                    <div class="browserStat">
                        <img src="{{asset('backend/img/Dashboard/browser-safari.png')}}" alt="Opera">
                        <span>{{$Operaes}}%</span>
                    </div>


                </div>
            </div>

            <div class="widget span6" onTablet="span6" onDesktop="span6">
                <h2><span class="glyphicons twitter"><i></i></span>پلت فرم بازدید %</h2>
                <hr>
                <div class="content ">
                    <canvas id="Platform" style="height:300px"></canvas>
                </div>
            </div>
            <div class="row-fluid">


                <div class="widget span6" onTablet="span6" onDesktop="span6">
                    <h2><span class="glyphicons twitter"><i></i></span>پلت فرم بازدید %</h2>
                    <hr>
                    <div class="content ">
                        <canvas id="product_seles" style="height:300px"></canvas>
                    </div>
                </div>

            </div>
            <script src="{{asset('FRONTED/js/jquery.js')}}"></script>
            <script>
                function charts(id, time, total) {
                    let myChart = document.getElementById(id).getContext('2d');

                    Chart.defaults.global.defaultFontFamily = 'Lato';
                    Chart.defaults.global.defaultFontSize = 18;
                    Chart.defaults.global.defaultFontColor = '#777';

                    let massPopChart = new Chart(myChart, {
                        type: 'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                        data: {
                            labels: time,
                            datasets: [{
                                label: 'میزان فروش',
                                data: total,

                                //backgroundColor:'green',
                                backgroundColor: [
                                    // 'rgba(255, 99, 132, 0.6)',
                                    'rgba(54, 162, 235, 0.6)',
                                    'rgba(255, 206, 86, 0.6)',
                                    'rgba(75, 192, 192, 0.6)',
                                    'rgba(153, 102, 255, 0.6)',
                                    'rgba(255, 159, 64, 0.6)',
                                    'rgba(255, 99, 132, 0.6)'
                                ],
                                borderWidth: 1,
                                borderColor: '#777',
                                hoverBorderWidth: 3,
                                hoverBorderColor: '#000'
                            }]
                        },
                        options: {
                            title: {
                                display: false,
                                text: 'Largest Cities In Massachusetts',
                                fontSize: 25
                            },
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    fontColor: '#000'
                                }
                            },
                            layout: {
                                padding: {
                                    left: 50,
                                    right: 0,
                                    bottom: 0,
                                    top: 0
                                }
                            },
                            tooltips: {
                                enabled: true
                            }
                        }
                    });
                }

                fetchRecords();


                function fetchRecords() {

                    $.ajax({
                        url: "{{ route('sales.Month') }}",
                        type: 'get',

                        dataType: 'json',
                        success: function (response) {
                            console.log(response);

                            var len = 0;
                            // {$('#myChart').empty(); // Empty <tbody>
                            if (response['data'] != null) {
                                len = response['data'].length;
                            }
                            var time = [];
                            var total = [];

                            for (var j in response) {
                                total.push(response[j].total);
                                time.push(response[j].time);
                            }


                            charts('myChart', time, total)

                        }
                    });
                }

                fetchDay();

                function fetchDay() {

                    $.ajax({
                        url: "{{ route('sales.Day') }}",
                        type: 'get',

                        dataType: 'json',
                        success: function (response) {
                            console.log(response);

                            var len = 0;
                            // {$('#myChart').empty(); // Empty <tbody>
                            if (response['data'] != null) {
                                len = response['data'].length;
                            }
                            var time = [];
                            var total = [];

                            for (var j in response) {
                                total.push(response[j].total);
                                time.push(response[j].time);
                            }
                            charts('day', time, total);


                        }
                    });
                }

                fetchPlatform();

                function fetchPlatform() {
                    $.ajax({
                        url: "{{ route('analyze.platform') }}",
                        type: 'get',

                        dataType: 'json',
                        success: function (response) {
                            console.log(response);

                            var len = 0;
                            // {$('#myChart').empty(); // Empty <tbody>
                            if (response['data'] != null) {
                                len = response['data'].length;
                            }
                            var time = [];
                            var total = [];


                            let myChart = document.getElementById('Platform').getContext('2d');

                            Chart.defaults.global.defaultFontFamily = 'Lato';
                            Chart.defaults.global.defaultFontSize = 18;
                            Chart.defaults.global.defaultFontColor = '#777';

                            let massPopChart = new Chart(myChart, {
                                type: 'horizontalBar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                                data: {
                                    labels: ['Windows', 'AndroidOS', 'iOS'],
                                    datasets: [{
                                        label: ['میزان پل فرم'],
                                        data: response,

                                        //backgroundColor:'green',
                                        backgroundColor: [
                                            // 'rgba(255, 99, 132, 0.6)',
                                            'rgba(54, 162, 235, 0.6)',
                                            'rgba(255, 206, 86, 0.6)',
                                            'rgba(75, 192, 192, 0.6)',
                                            'rgba(153, 102, 255, 0.6)',
                                            'rgba(255, 159, 64, 0.6)',
                                            'rgba(255, 99, 132, 0.6)'
                                        ],
                                        borderWidth: 1,
                                        borderColor: '#777',
                                        hoverBorderWidth: 3,
                                        hoverBorderColor: '#000'
                                    }]
                                },
                                options: {
                                    title: {
                                        display: false,
                                        text: 'Largest Cities In Massachusetts',
                                        fontSize: 25
                                    },
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            fontColor: '#000'
                                        }
                                    },
                                    layout: {
                                        padding: {
                                            left: 50,
                                            right: 0,
                                            bottom: 0,
                                            top: 0
                                        }
                                    },
                                    tooltips: {
                                        enabled: true
                                    }
                                }
                            });
                        }
                    });
                }

                fetchproduct_seles();

                function fetchproduct_seles() {
                    $.ajax({
                        url: "{{ route('analyze.category') }}",
                        type: 'get',

                        dataType: 'json',
                        success: function (response) {
                            console.log(response);

                            var len = 0;
                            // {$('#myChart').empty(); // Empty <tbody>
                            if (response['data'] != null) {
                                len = response['data'].length;
                            }
                            var time = [];
                            var total = [];


                            let myChart = document.getElementById('product_seles').getContext('2d');

                            Chart.defaults.global.defaultFontFamily = 'Lato';
                            Chart.defaults.global.defaultFontSize = 18;
                            Chart.defaults.global.defaultFontColor = '#777';

                            let massPopChart = new Chart(myChart, {
                                type: 'radar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
                                data: {
                                    labels: ['Windows', 'AndroidOS', 'iOS'],
                                    datasets: [{
                                        label: ['میزان پل فرم'],
                                        data: response,

                                        //backgroundColor:'green',
                                        backgroundColor: [
                                            // 'rgba(255, 99, 132, 0.6)',
                                            'rgba(54, 162, 235, 0.6)',
                                            'rgba(255, 206, 86, 0.6)',
                                            'rgba(75, 192, 192, 0.6)',
                                            'rgba(153, 102, 255, 0.6)',
                                            'rgba(255, 159, 64, 0.6)',
                                            'rgba(255, 99, 132, 0.6)'
                                        ],
                                        borderWidth: 1,
                                        borderColor: '#777',
                                        hoverBorderWidth: 3,
                                        hoverBorderColor: '#000'
                                    }]
                                },
                                options: {
                                    title: {
                                        display: false,
                                        text: 'Largest Cities In Massachusetts',
                                        fontSize: 25
                                    },
                                    legend: {
                                        display: true,
                                        position: 'right',
                                        labels: {
                                            fontColor: '#000'
                                        }
                                    },
                                    layout: {
                                        padding: {
                                            left: 50,
                                            right: 0,
                                            bottom: 0,
                                            top: 0
                                        }
                                    },
                                    tooltips: {
                                        enabled: true
                                    }
                                }
                            });
                        }
                    });
                }


                function fetch() {
                    fetchRecords();
                    fetchYear();
                    fetchDay();
                }


            </script>

@endsection