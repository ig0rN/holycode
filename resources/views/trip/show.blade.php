@extends('layouts.app')

@section('title')
 Show Trip - {{ $trip->title }}
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="slova col-md-8 text-center">

            <h2>Here is your map of trip "<strong><i>{{ $trip->title }}</i></strong>"</h2>
                
            <div class="mt-5 mb-5" id="map" style="width: 100%; height: 600px;"></div>

            <a cl href="{{ route('home') }}"
                <button type="button" class="btn btn-warning">Go back</button>
            </a>
    
        </div>
    </div>
</div>
@endsection

@section('script')

    <script src="/js/loadgpx.js"></script>

    <script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js">
    </script>

    <script type="text/javascript">
        //<![CDATA[
        function loadGPXFileIntoGoogleMap(map, filename) {
            $.ajax({url: filename,
                dataType: "xml",
                success: function(data) {
                var parser = new GPXParser(data, map);
                parser.setTrackColour("#ff0000");     // Set the track line colour
                parser.setTrackWidth(5);          // Set the track line width
                parser.setMinTrackPointDelta(0.001);      // Set the minimum distance between track points
                parser.centerAndZoom(data);
                parser.addTrackpointsToMap();         // Add the trackpoints
                parser.addRoutepointsToMap();         // Add the routepoints
                parser.addWaypointsToMap();           // Add the waypoints
                }
            });
        }
        function loadMap(){                
            $(document).ready(function() {
                var map = new google.maps.Map(document.getElementById("map"),{
                    // mapTypeId: 'terrain'
                });
                loadGPXFileIntoGoogleMap(map, "/storage/{{ $trip->file_name}}");
            });
        //]]>
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjwvMGtxi8lvSzIFkSNgr7Y0snqJzLRw0&callback=loadMap">
    </script>

@endsection
