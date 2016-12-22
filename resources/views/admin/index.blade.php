@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('css')

@stop

@section('content')
  <div class="row">
    <div class="col-sm-12">
      <div class="row">
        <div class="col-sm-4">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-car"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">{{$kejadian->count()}} Kejadian</span>
              <span class="info-box-text">Kecelakaan Lalu Lintas Tersimpan</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-sm-4">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-child"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">{{$korban->count()}}</span>
              <span class="info-box-text">Korban</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-sm-4">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">{{ App\Kendaraan::all()->count() }}</span>
              <span class="info-box-text">Kendaraan</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Statistik Perbandingan Kecelakaan</h3>
        </div>
        <div class="box-body">
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Statistik Jumlah Kendaraan yang Kecelakaan</h3>
        </div>
        <div class="box-body">
          <canvas id="pieChart"></canvas>
        </div>
      </div>
    </div>
  </div>

@stop


@section('js')
    <script src="{{ asset('js/Chart.bundle.min.js') }}" charset="utf-8"></script>
    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Sleman", "Kota", "Bantul", "Kulon Progo", "Gunungkidul"],
                datasets: [{
                    label: 'Angka Kecelakaan',
                    data: {{ json_encode($angka) }},
                    backgroundColor: [
                        '#DDDDDD',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        var piechart = document.getElementById("pieChart");
        var myChart = new Chart(piechart, {
            type: 'pie',
            data: {
                labels: [
                  "{{ $angkakendaraan[0]->tipe_kendaraan }}",
                  "{{ $angkakendaraan[1]->tipe_kendaraan }}",
                  "{{ $angkakendaraan[2]->tipe_kendaraan }}",
                  "{{ $angkakendaraan[3]->tipe_kendaraan }}",
                  "{{ $angkakendaraan[4]->tipe_kendaraan }}",
                ],
                datasets: [{
                    label: 'Angka Kecelakaan',
                    data: [
                      {{ $angkakendaraan[0]->jumlah }},
                      {{ $angkakendaraan[1]->jumlah }},
                      {{ $angkakendaraan[2]->jumlah }},
                      {{ $angkakendaraan[3]->jumlah }},
                      {{ $angkakendaraan[4]->jumlah }}
                    ],
                    backgroundColor: [
                        '#F44336',
                        '#3F51B5',
                        '#039BE5',
                        '#00838F',
                        '#FF5722'
                    ],
                }]
            }
        });
    </script>
@stop
