@extends('adminlte::page')

@section('title', 'Peta Sebaran Kecelakaan')

@section('content_header')
    <h1>Peta Sebaran Kecelakaan</h1>
@stop

@section('css')

@stop

@section('content')
  <div class="row">
    <div id="map" style="height: 500px; margin-bottom: 10px;">

    </div>
  </div>
  <div class="row">

    <div class="col-sm-12">
      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-filter"></i> Filter</h3>
          <div class="box-body">
            <form class="" action="{{ route('filterurl') }}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-sm-12 label-control">Tahun</label>
                    <select class="form-control" name="month">
                      <option value="1">Januari</option>
                      <option value="2">Februari</option>
                      <option value="3">Maret</option>
                      <option value="4">April</option>
                      <option value="5">Mei</option>
                      <option value="6">Juni</option>
                      <option value="7">Juli</option>
                      <option value="8">Agustus</option>
                      <option value="9">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="col-sm-12 label-control">Bulan</label>
                    <select class="form-control" name="year">
                      @for ($i=2016; $i < 2020; $i++)
                        <option value="{{$i}}">{{$i}}</option>
                      @endfor
                    </select>
                  </div>
                </div>
                <div class="col-sm-4">
                  <label class="col-sm-12 label-control">&nbsp;</label>
                  <button type="sumbit" class="btn btn-primary">Filter</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-12">
      <div class="box box-danger">
        <div class="box-body">
          <table id="tabel-kejadian" class="table table-hover">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Kabupaten</th>
                <th>Kendaraan</th>
                <th>Korban</th>
                <th></th>
              </tr>

            </thead>
            <tbody>
              @foreach ($kejadian as $kecelakaan)
                <tr>
                  <td>{{ $kecelakaan->waktu_kejadian->format('d F Y') }}</td>
                  <td>{{ $kecelakaan->waktu_kejadian->format('H:i') }}</td>
                  <td>{{ $kecelakaan->latitude }}</td>
                  <td>{{ $kecelakaan->longitude }}</td>
                  <td>{{ $kecelakaan->kabupaten->nama }}</td>
                  <td>{{ $kecelakaan->kendaraan->count() }}</td>
                  <td>{{ $kecelakaan->kendaraan->count() }}</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('showDetilLakalantas', ['id' => $kecelakaan->id ])}}" class="btn bg-green"><i class="fa fa-eye"></i></a>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@stop

@section('js')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRijsRVPPetZDnC3tCInbEO-uZ6hLiUeI"></script>
  <script src="{{ asset('/js/gmaps.js') }}"></script>
  <script>
    var map = new GMaps({
      el: '#map',
      lat: -7.7710649,
      lng: 110.3865498
    });
    </script>

    @foreach ($kejadian as $kecelakaan)
      <script type="text/javascript">
      map.addMarker({
        lat: {{ $kecelakaan->latitude }},
        lng: {{ $kecelakaan->longitude }},
        infoWindow: {
          content: '<p>Kendaraan : {{ $kecelakaan->kendaraan->count() }}</p><a class="btn btn-primary" href="{{ route('showDetilLakalantas', ['id' => $kecelakaan->id ])}}">Detail</a>'
        }
      });
      </script>
    @endforeach
@endsection
