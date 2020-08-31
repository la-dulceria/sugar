@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Mapa de envíos</h1>
@stop

@section('content')
    <div style="width: 640px; height: 480px" id="mapContainer"></div>
@stop

@section('css')
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"
            type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"
            type="text/javascript" charset="utf-8"></script>
@stop

@section('js')
    <script>
        var platform = new H.service.Platform({
            'apikey': 'ro7JhmZ_Uaa92ZS7I5srU8CTE6EgupjunKRlb1W00Qs'
        });

        // Obtain the default map types from the platform object:
        var defaultLayers = platform.createDefaultLayers();

        // Instantiate (and display) a map object:
        var map = new H.Map(
            document.getElementById('mapContainer'),
            defaultLayers.vector.normal.map,
            {
                zoom: 10,
                center: { lat: 52.5, lng: 13.4 }
            });
    </script>
@stop
