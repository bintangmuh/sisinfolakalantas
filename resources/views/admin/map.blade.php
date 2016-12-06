@extends('adminlte::page')

@section('title', 'Peta Sebaran Kecelakaan')

@section('content_header')
    <h1>Peta Sebaran Kecelakaan</h1>
@stop

@section('css')

@stop

@section('content')
  <div class="row">
    <div id="map" style="height: 500px">

    </div>

  </div>
@stop

@section('js')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRijsRVPPetZDnC3tCInbEO-uZ6hLiUeI"></script>
  <script src="{{ asset('/js/gmaps.js') }}"></script>
  <script>
    $(document).ready(function() {
      $.ajax({
          type: 'GET',
          url: '//localhost:8000/api/kejadian',
          data: { get_param: 'value' },
          success: function (data) {
              console.log(data[0].latitude);
              console.log(data[0].longitude);
              map.addMarker({
                lat: data[0].latitude,
                lng: data[0].longitude,
                title: data[0].kendaraan[0].merk,
                infoWindow: {
                  content: '<h3>Kecelakaan:'+data[0].kendaraan[0].merk+'</h3><p>Pengemudi : '+data[0].kendaraan[0].pengemudi.name+'</p>'
                }
              });
              $('#cand').html(data);
          }
      });
    });
    var map = new GMaps({
      el: '#map',
      lat: -7.7710649,
      lng: 110.3865498
    });
    </script>
@endsection
