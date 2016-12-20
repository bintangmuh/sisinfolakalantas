@extends('adminlte::page')

@section('title', 'Detail Kecelekaan')


@section('content_header')
    <h1>Detail Kecelakaan</h1>
@stop

@section('css')

@stop

@section('content')
  <div class="row">
    <div class="col-sm-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Lokasi</h3>
        </div>
        <div class="box-body">
          <div id="map-thumbnail" style="height: 350px;">
          </div>
          <p>
            <b>Latitude:</b> {{ $kejadian->latitude }} <br>
            <b>Longitude:</b> {{ $kejadian->longitude }} <br>
            <b>Kabupaten</b> {{ $kejadian->kabupaten->nama }}
          </p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title">Kendaraan</h3>
        </div>
        <div class="box-body">
          <table class="table">
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
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="box box-warning">
        <div class="box-header">
          <h3 class="box-title">Korban</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Umur</th>
                <th>Kondisi</th>
                <th>Kendaraan</th>

              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="box box-warning">
        <div class="box-header wih border">
          <h3 class="box-title">Tambah Korban</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <tr>
              <td>
                <label for="">Nama</label>
              </td>
              <td>
                <label for="">Jenis Kelamin</label>
              </td>
              <td>
                <label for="">Umur</label>
              </td>
              <td>
                <label for="">Kondisi</label>
              </td>
              <td>
                <label for="">Kendaraan</label>
              </td>
              <td>
              </td>
            </tr>
            <form class="" action="index.html" method="post">
              <tr>
                <td>
                  <input type="text" name="nama" value="">
                </td>
                <td>
                  <input type="text" name="Jenis kelamin" value="">
                </td>
                <td>
                  <input type="number" name="umur" value="">
                </td>
                <td>
                  <input type="text" name="umur" value="">
                </td>
                <td>
                  <input type="text" name="umur" value="">
                </td>
                <td>
                  <button type="submit" class="btn btn-primary" name="button" value="">Submit</button>
                </td>
              </tr>
            </form>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop

<script src="{{ asset('/js/jquery.js') }}" charset="utf-8"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRijsRVPPetZDnC3tCInbEO-uZ6hLiUeI"></script>
<script src="/js/gmaps.js"></script>
<script>
  $(document).ready(function() {
    var element = ".col-sm-6 .box .box-body #map-thumbnail";
    $(element).html('<h4><i class="fa fa-exclamation-circle"></i> Error Loading Google Maps</h4>');
    var map = new GMaps({
      el: '.box .box-body #map-thumbnail',
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

  });


</script>
