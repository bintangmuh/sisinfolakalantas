@extends('adminlte::page')

@section('title', 'Dashboard')

@php
use Faker\Factory as Faker;
$faker = Faker::create();
$faker->addProvider(new \Faker\Provider\id_ID\Person($faker));
$faker->addProvider(new \Faker\Provider\id_ID\Address($faker));
$faker->addProvider(new \Faker\Provider\Base($faker));

@endphp


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
            <th>Asal</th>
            <th>Kondisi</th>
            <th>Kendaraan</th>
            <th>Tanggal Kecelakaan</th>
          </tr>
        </thead>
        <tbody>
          @for ($i=1; $i < 100; $i++)
            <tr>
              <td>{{ $i }}</td>
              <td>{{ $faker->name }}</td>
              <td>Pria</td>
              <td>22</td>
              <td>{{ $faker->address }}</td>
              <td>Luka Ringan</td>
              <td>Motor</td>
              <td>7 Desember 2016</td>
            </tr>
          @endfor
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
