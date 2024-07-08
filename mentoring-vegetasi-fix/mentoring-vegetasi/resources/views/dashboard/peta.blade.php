@extends('layouts.app')

@section('background_url', '/assets/topographic-3.svg')

{{-- @section('content')
    <iframe class="w-100"
        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1707722.6914473057!2d107.93459947963298!3d-6.200693436086146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sid!2sid!4v1718352484430!5m2!1sid!2sid"
        style="border:0; height:60vh;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
@endsection --}}

@section('content')
    <div id="map" style="height: 500px;"></div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <script>
        var map = L.map('map').setView([-2.5, 120], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var spesies = @json($spesies);
        var vegetasi = @json($vegetasi);

        // spesies.forEach(function(spesies) {
        //     L.marker([spesies.latitude, spesies.longitude]).addTo(map)
        //         .bindPopup('<b>' + spesies.nama_spesies + '</b><br>' + spesies.deskripsi);
        // });
        // console.log(spesies);
        spesies.forEach(function(spesies) {
            var markerColor = '#FFFFF';

            var matchingVegetasi = vegetasi.find(function(vegetasi) {
                return vegetasi.id === spesies.fk_id_vegetasi;
            });

            if (matchingVegetasi) {
                markerColor = matchingVegetasi.hex_code;
                console.log(markerColor);
            }
            L.circleMarker([spesies.latitude, spesies.longitude], {
                    radius: 5,
                    color: markerColor,
                    fillColor: markerColor,
                    fillOpacity: 0.8
                }).addTo(map)
                .bindPopup('<a href="{{ route('dashboard.spesies.show', '') }}/' + spesies.id + '">' + spesies.nama_spesies + '</a><br>' + spesies.longitude + ' ; ' + spesies.latitude);

        });

    </script>
@endsection
