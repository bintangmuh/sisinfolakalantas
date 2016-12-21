@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
    <h1>Data Korban kecelakaan</h1>
@stop

@section('css')

@stop

@section('content')
  <div class="box box-danger">
    <div class="box-header">
      <h3 class="box-title">Data Korban</h3>
    </div>
    <div class="box-body">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Umur</th>
            <th>Kondisi</th>
            <th>Kendaraan</th>
            <th>Tanggal Kecelakaan</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($korban as $korbannya)
            <tr>
              <td>{{ $korbannya->id }}</td>
              <td>{{ $korbannya->nama }}</td>
              <td>{{ $korbannya->jenis_kelamin }}</td>
              <td>{{ $korbannya->umur }} tahun</td>
              <td>{{ $korbannya->kondisi }}</td>
              @if ($korbannya->kendaraan_id != 0)
                <td>{{ $korbannya->kendaraan->tipe_kendaraan }}</td>
              @else
                <td>Tidak Berkendara</td>
              @endif
              <td>{{$korbannya->kejadian->waktu_kejadian}}</td>
            </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
@stop

@section('js')
  <script src="//cdn.datatables.net/plug-ins/1.10.12/i18n/Indonesian.json" charset="utf-8"></script>
  <script type="text/javascript">
    $('.table').DataTable(
    {
       "sProcessing":   "Sedang proses...",
       "sLengthMenu":   "Tampilan _MENU_ entri",
       "sZeroRecords":  "Tidak ditemukan data yang sesuai",
       "sInfo":         "Tampilan _START_ sampai _END_ dari _TOTAL_ entri",
       "sInfoEmpty":    "Tampilan 0 hingga 0 dari 0 entri",
       "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
       "sInfoPostFix":  "",
       "sSearch":       "Cari:",
       "sUrl":          "",
       "oPaginate": {
           "sFirst":    "Awal",
           "sPrevious": "Balik",
           "sNext":     "Lanjut",
           "sLast":     "Akhir"
       }
    });
  </script>
    @endsection
