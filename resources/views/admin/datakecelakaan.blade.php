@extends('adminlte::page')

@section('title', 'Data Kecelakaan')


@section('content_header')
    <h1>Data kecelakaan</h1>
@stop

@section('css')
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/dataTables.bootstrap.css">
@stop

@section('content')
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
                  <a href="#" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                  <button type="button" class="btn btn-danger"><i class="fa fa-remove"></i></button>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@stop

@section('js')
  <script type="text/javascript">
    $(document).ready(function() {
      $('#tabel-kejadian').DataTable();
    });
  </script>
@endsection
