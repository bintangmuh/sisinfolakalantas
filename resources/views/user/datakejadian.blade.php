@extends('layouts.appmaterial')

@section('title', 'Kecelakaan')

@section('css')
  <style media="screen">

  </style>
@endsection

@section('content')
  @include('components.navbar')

  <div class="container">
      <div class="col s12">
        <h4>Data Laporan Kecelakaan</h4 >
        <table id="#dataTable" class="coba striped bordered">
          <thead>
            <tr>
              <th class="center-align">Waktu Kejadian</th>
              <th class="center-align">Kabupaten</th>
              <th class="center-align">Latitude</th>
              <th class="center-align">Longitude</th>
              <th class="center-align">Jumlah Kendaraan</th>
              <th class="center-align">Jumlah Korban</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($kejadian as $kecelakaan)
              <tr >
                <td class="center-align">{{ $kecelakaan->waktu_kejadian->format('d F Y H:i') }}</td>
                <td class="center-align">{{ $kecelakaan->kabupaten->nama }}</td>
                <td class="center-align">{{ $kecelakaan->latitude }}</td>
                <td class="center-align">{{ $kecelakaan->longitude }}</td>
                <td class="center-align">{{ $kecelakaan->kendaraan->count() }} unit</td>
                <td class="center-align">{{ $kecelakaan->korban->count() }} orang</td>
                <td class="center-align"><a href="/detail/{{$kecelakaan->id}}" class="btn waves-effect">LIHAT</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $kejadian->links() }}
      </div>
  </div>
@endsection

@section('js')

@endsection
