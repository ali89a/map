<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        #map {
            width: 100%;
            height: 80vh;
            background-color: gray;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">Location</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/register') }}">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/login') }}">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="map">

                </div>
            </div>
        </div>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('google_map')['map_apikey'] }}&callback=initMap"></script>
        <!-- <script>
            function initMap() {
                const myLatLng = {
                    lat: 23.822350,
                    lng: 90.365417
                };
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 11,
                    center: myLatLng,
                });

                new google.maps.Marker({
                    position: myLatLng,
                    map,
                    title: "Hello World!",
                });
            }

            window.initMap = initMap;
        </script> -->
        <script>
            function initMap() {

                var mapElement = document.getElementById('map');
                var url = `/map-marker`;

                async function markerscodes() {
                    var data = await axios(url);
                    var lacationData = data.data;
                    mapDisplay(lacationData);
                }
                markerscodes();

                function mapDisplay(datas) {

                    //map options
                    var options = {
                        center: {
                            lat: Number(datas[0].latitude),
                            lng: Number(datas[0].longitude)
                        },
                        zoom: 7
                    }
                    // Create a map object and specify the DOM element for display.
                    var map = new google.maps.Map(mapElement, options);


                    var markers = new Array();

                    for (let index = 0; index < datas.length; index++) {
                        markers.push({
                            coords: {
                                lat: Number(datas[index].latitude),
                                lng: Number(datas[index].longitude)
                            },
                            //iconImage:'https://maps.google.com/mapfiles/kml/shapes/',
                            content: `<div><h5>${datas[index].area}</h5></div>`
                        })
                    }

                    //loop through marker
                    for (var i = 0; i < markers.length; i++) {
                        addMarker(markers[i]);
                    }

                    //addMarker();
                    function addMarker(props) {
                        var marker = new google.maps.Marker({
                            position: props.coords,
                            map: map
                        });

                        if (props.content) {

                            var infowindow = new google.maps.InfoWindow({
                                content: props.content
                            });

                            marker.addListener('click', function() {
                                infowindow.open(map, marker);
                            });

                        }
                    }


                };

            } //initMap end
        </script>
</body>

</html>