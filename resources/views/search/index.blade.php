@extends('dashboard.dashboardlayout')

@section('content')
{{-- to fix the navbar area --}}
<div class="container-fluid top-container">

    {{-- imports --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    {{-- imports --}}
    <style>
        #mapid {
            height: 550px;
            width: 80%;
        }
    </style>

    <input type="hidden" id="_token" value={{ csrf_token() }}>


    <h6> Search Volunteer </h6>
    <div id="noPosition" class="my-5" style="display: none">
        <div class="text-center">
            <h3 class="text-danger">Location not authorized. Please check your location permissions settings.</h3>

        </div>
    </div>


    <div class="d-flex justify-content-center">
        <div id="mapid"></div>

    </div>

    {{-- Request Waiting Modal --}}
    <div class="modal fade" id="requestWaitingModal" tabindex="-1" aria-labelledby="requestWaitingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-secondary text-success text-uppercase" id="requestWaitingModalLabel">
                        Waiting for Volunteer to Accept</h5>
                    <button type="button" onclick="closeRequestModal()" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="h3 text-center fw-bold" id="clock"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="closeRequestModal()" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Request Waiting Modal Ends --}}

    {{-- Scripts --}}

    <script>
        function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition, positionNotFound);
                } else {}
            }

            function positionNotFound() {
                let position = document.getElementById("noPosition");
                position.style.display = "block";
            }

            function showPosition(position) {
                const {
                    latitude,
                    longitude
                } = position.coords;
                // console.log(latitude,longitude);
                myLocationSetter(latitude, longitude);
            }

            getLocation();


            function requestUser(volunteerId) {
                postRequestUser(volunteerId, '{{ route('work.request', ['id' => session('userid')]) }}')
            }
    </script>


    <script>
        var latitudeGlob;
          var longitudeGlob;

            var mymap = null;

            function myLocationSetter(latitude, longitude) {
                mymap = L.map('mapid').setView([latitude, longitude], 13);
                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                    attribution: 'OVMS',
                    maxZoom: 18,
                    // zoom: 16,
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1,
                    accessToken: 'pk.eyJ1IjoiY2gxc3R5IiwiYSI6ImNrdHJlMm02bDE1a2wycG85dDF0MDIyMnoifQ.cBXlMRYQRO0ZS0X8sgIaSg'
                }).addTo(mymap);




                {!! $markerScript !!}

                L.marker([latitude, longitude]).addTo(mymap)
                    .bindPopup('Your Current Location')
                    .openPopup();



                //PATH FORMATIING
                latitudeGlob = latitude;
                longitudeGlob = longitude;

                // L.Routing.control({
                //     waypoints: [
                //         L.latLng(latitude, longitude),
                //         L.latLng(latitude, longitude+.05)
                //     ]
                // }).addTo(mymap);


            }

    </script>



    <script src="{{ asset('assets/js/hire.js') }}"></script>


    {{-- end of scripts --}}
</div>
@endsection