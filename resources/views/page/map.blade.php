@extends('conent_left')
@section('content-panel')


    <div class="container ">
        <div class="row">
            {{--@include('conent_left')--}}

            <div class="col-sm-9 clearfix">
                <div class="bill-to">
                    <div class="form-one float-right " style="float:right;">
                        <form action="{{url('panel_user/set_shipp')}}" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <head>
                                    <meta charset=utf-8/>
                                    <!--<script src='../dist/v1.8.1/cedarmaps.js'></script>-->
                                    <script src="{{asset('FRONTED/src_map/L.Control.Locate.min.js')}}"></script>
                                    <script src="{{asset('FRONTED/src_map/cedarmap.js')}}"></script>
                                    <link href='https://api.cedarmaps.com/cedarmaps.js/v1.8.1/cedarmaps.css'
                                          rel='stylesheet'/>
                                    {{--                                <link href="{{asset('FRONTED/src_map/custom-bootstrap.css')}} "rel='stylesheet' />--}}
                                    <link href="{{asset('FRONTED/src_map/styles.css')}}" rel='stylesheet'/>
                                    <link href="{{asset('FRONTED/src_map/L.Control.Locate.min.css' )}}"
                                          rel='stylesheet'/>
                                    <link href="{{asset('FRONTED/src_map/reverse-geocoder.css')}}" rel='stylesheet'/>
                                    <link href="{{asset('FRONTED/src_map/fonts.css')}}" rel='stylesheet'/>
                                    <link href="{{asset('FRONTED/src_map/icons.css')}}" rel='stylesheet'/>
                                    s

                                </head>

                                <div id='map' class='map w-50 h-50' style="width: 50%;height: 50% "></div>

                            </div>


                            <div class="row" style="margin-top: 500px">
                                <input type="hidden" id="latitude" class="rounded" name="Latitude"/>
                                <input type="hidden" id="longitude" class="rounded" name="Longitude"/>

                                <input type="text" style="width:600px ;text-align: center;" placeholder="ادرس *"
                                       name="adderss" id="adderss">
                                @if ($errors->has('adderss'))
                                    <span class="invalid-feedback" role="alert">
           <strong>{{ $errors->first('adderss') }}</strong>
           </span>
                                @endif
                                <input type="text" style="width:600px;text-align: center;" placeholder="ادرس"
                                       name="adderss_hand">
                                @if ($errors->has('adderss_hand'))
                                    <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('adderss_hand') }}</strong>
          </span>
                                @endif
                                <input type="text" style="width:600px;text-align: center;" placeholder="پلاک *"
                                       id="email" name="plak">
                                @if ($errors->has('plak'))
                                    <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('plak') }}</strong>
          </span>
                                @endif
                                <input type="text" style="width:600px;text-align: center;" placeholder="واحد *"
                                       name="unit">
                                @if ($errors->has('unit'))
                                    <span class="invalid-feedback" role="alert">
         <strong>{{ $errors->first('unit') }}</strong>
          </span>
                                @endif
                                <input type="text" style="width:600px;text-align: center;" placeholder="کدپستی *"
                                       name="post" required>
                                @if ($errors->has('post'))
                                    <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('post') }}</strong>
           </span>
                                @endif
                                <button class="btn btn-default "
                                        style="margin-bottom: 10px;padding: 6px 93px 6px 94px;float: right">ثبت
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        try {
            // Check out line 9 where we have imported a file which has an `accessToken` variable available on it as has
            // been assigned our personal access token.
            // Sample: var accessToken = '<your access token>';
            // Get one from https://www.cedarmaps.com
            L.cedarmaps.accessToken = "{{env('MAP_API')}}";
        } catch (err) {
            throw new Error('You need to get an access token to be able to use cedarmaps SDK. ' +
                'Send us an email to <support@cedarmaps.com>');
        }

        var tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken,
            marker;

        // Initializing our map
        var map = L.cedarmaps.map('map', tileJSONUrl, {
            scrollWheelZoom: true
        }).setView([35.757552763570196, 51.41000747680664], 15);

        // Making references to our DOM elements
        var longitude = document.getElementById('longitude'),
            latitude = document.getElementById('latitude'),
            adderss = document.getElementById('adderss'),

            verbosityCheckbox = document.getElementById('verbosity');

        // Initializing the Geocoder object which has the necessary methods for reverse geocoding
        // We also need to introduce our search index to geocoder module, `cedarmaps.streets` in this case.
        // This means the reverse geocoder engine should search in our `cedarmaps.streets` index.
        var geocoder = L.cedarmaps.geocoder('cedarmaps.streets');
        window.onload = function () {

        };
        map.on('click', function (e) {

            // If we have already clicked on map, a marker is placed on it and we should remove it before we add one again on user click.
            if (marker) map.removeLayer(marker);

            // Cedarmaps SDK is based on Leaflet.js. A leaflet marker is initialized like this. The event object (`e`) which is passed in by onClick event contains the latLng object.
            // Learn more: https://leafletjs.com/reference-1.5.0.html#marker
            marker = new L.marker(e.latlng).addTo(map);

            longitude.value = parseFloat(e.latlng.lng).toPrecision(10);
            latitude.value = parseFloat(e.latlng.lat).toPrecision(10);
            var q = {
                query: e.latlng,
                verbosity: '',
                prefix: 'long',
            };

            // This is the main part of this demo which uses the `reverseQuery` method. For more info on other available options please refer to docs.
            // https://github.com/cedarstudios/cedarmaps-web-sdk-raster/blob/master/README.md
            geocoder.reverseQuery(q, function callback(err, res) {
                var parsedResponse = res.result.city + ' , ' + res.result.locality + res.result.place + ' , ' + res.result.address;
                var rawResponse = '<pre class="language-javascript">' + syntaxHighlight(JSON.stringify(res, undefined, 2)) + '</pre>'

                adderss.value = parsedResponse;
            });
        });

        // This function is just used for JSON syntax highlighting specifically for this demo and has nothing to do with CedarMaps SDK
        function syntaxHighlight(json) {
            json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
                var cls = 'number';
                if (/^"/.test(match)) {
                    if (/:$/.test(match)) {
                        cls = 'key';
                    } else {
                        cls = 'string';
                    }
                } else if (/true|false/.test(match)) {
                    cls = 'boolean';
                } else if (/null/.test(match)) {
                    cls = 'null';
                }
                return '<span class="' + cls + '">' + match + '</span>';
            });
        }
    </script>
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
    </script>

@endsection
