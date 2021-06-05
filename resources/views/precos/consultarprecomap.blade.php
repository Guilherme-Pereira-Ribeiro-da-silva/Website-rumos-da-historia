@extends('layoutpadrao')

@section('body')
    <div id="map" class="map" style="width: 100%;">

    </div>

    <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYNPL89IWtivlLIQceiZc5D3SdPYIVL3g&callback=initMap"></script>
    <script>
        function initMap() {
            let options = {
                center:{lat: -23.533773,lng:-46.625290},
                zoom:8
            }

            let map = new google.maps.Map(document.getElementById('map'),options);
        }
    </script>
@endsection

