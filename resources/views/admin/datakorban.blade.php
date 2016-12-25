@extends('adminlte::page')

@section('title', 'Dashboard')


@section('content_header')
    <h1>Data Korban kecelakaan</h1>
@stop

@section('css')

@stop

@section('content')
  <div class="row">
    <div class="col-sm-4">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Statistik Korban Berdasar Jenis Kelamin</h3>
        </div>
        <div class="box-body">
          <canvas id="genderchart"></canvas>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Statistik Korban Berdasar Rentang Umur</h3>
        </div>
        <div class="box-body">
          <canvas id="umurchart"></canvas>
        </div>
      </div>
    </div>
  </div>
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
  <script src="{{ asset('js/Chart.bundle.min.js') }}" charset="utf-8"></script>
  <script type="text/javascript">
    $('.table').DataTable();

    $(document).ready(function() {


      var umur = document.getElementById("umurchart");
      var anotherchart = new Chart(umurchart, {
          type: 'pie',
          data: {
              labels: [
                "0-5 tahun",
                "6-16 tahun",
                "17-50 tahun",
                "diatas 50 tahun",
              ],
              datasets: [{
                  label: '',
                  data: [
                    {{ $umur['balita'] }},
                    {{ $umur['anak'] }},
                    {{ $umur['dewasa'] }},
                    {{ $umur['lansia'] }},
                  ],
                  backgroundColor: [
                      '#F44336',
                      '#3F51B5',
                      '#73b53f',
                      '#ff8457',
                  ],
              }]
          }
      });

      var genderchart = document.getElementById("genderchart");
      var myChart = new Chart(genderchart, {
          type: 'pie',
          data: {
              labels: [
                "Laki-laki",
                "Perempuan",
              ],
              datasets: [{
                  label: '',
                  data: [
                    "{{ $gender[0]->jumlah }}",
                    "{{ $gender[1]->jumlah }}",
                  ],
                  backgroundColor: [
                      '#F44336',
                      '#3F51B5',

                  ],
              }]
          }
      });
    });
  </script>
    @endsection
