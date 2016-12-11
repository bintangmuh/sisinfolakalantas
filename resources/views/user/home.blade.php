@extends('layouts.appmaterial')

@section('title', 'Beranda')

@section('content')
  @include('components.navbar')
  <div class="container-fluid">
    <div id="map" style="height: 90vh">

    </div>
  </div>
  <div class="fixed-action-btn">
    <a class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
  </div>
@endsection


@section('js')

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRijsRVPPetZDnC3tCInbEO-uZ6hLiUeI"></script>
  <script src="/js/gmaps.js"></script>
  <script>
    var map = new GMaps({
      el: '#map',
      lat: -7.7710649,
      lng: 110.3865498
    });
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
                  content: '<h5>Kecelakaan:'+data[0].kendaraan[0].merk+'</h5><p>Pengemudi : '+data[0].kendaraan[0].pengemudi.name+'</p>'
                }
              });
              $('#cand').html(data);
          }
      });
    });



  </script>
@endsection
