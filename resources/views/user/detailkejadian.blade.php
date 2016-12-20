@extends('layouts.appmaterial')

@section('title', 'Kecelakaan')

@section('content')
  @include('components.navbar')

  <div class="container-fluid">
    <div class="row">
      <div id="map-thumbnail" class="col s8">

      </div>
      <div class="col s4">
        <h4>Detail Kecelakaan</h4>
        <p>Lokasi: {{$kejadian->latitude}}, {{$kejadian->longitude}}</p>
        <p>Tanggal Kejadian: {{$kejadian->waktu_kejadian->format('d F Y')}}</p>
        <p>Waktu Kejadian: {{$kejadian->waktu_kejadian->format('h:i')}}</p>

        <h4>Kendaraan</h4>
        {{-- Tabel Kendaraan --}}
        <table class="highlight striped">
          <thead>
            <tr>
              <th>Plat Nomor</th>
              <th>Tipe Kendaraan</th>
              <th>Merk</th>
              <th>Warna</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($kejadian->kendaraan as $kendaraan)
              <tr>
                <td>{{ $kendaraan->platnomor }}</td>
                <td>{{ $kendaraan->tipe_kendaraan }}</td>
                <td>{{ $kendaraan->merk }}</td>
                <td>{{ $kendaraan->warna }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col s12">
          <h5>Daftar Korban</h5>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRijsRVPPetZDnC3tCInbEO-uZ6hLiUeI"></script>
  <script src="/js/gmaps.js"></script>
  <script>
    var map = new GMaps({
      el: "#map-thumbnail",
      lat: {{$kejadian->latitude}},
      lng: {{$kejadian->longitude}},
      zoom: 18
    });

    map.addMarker({
      lat: {{$kejadian->latitude}},
      lng: {{$kejadian->longitude}},
      icon : {
        url : "{{ asset('/img/kecelakaan.png')}}"
      }
    });



  </script>
@endsection
