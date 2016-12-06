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
      <h4>Hari ini..</h4>
      <div class="row">
        <div class="col-sm-4">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-car"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">90 Kejadian</span>
              <span class="info-box-text">Kecelakaan Kendaraan</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-sm-4">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-child"></i></span>

            <div class="info-box-content">
              <span class="info-box-number">100</span>
              <span class="info-box-text">Korban</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-sm-4">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">CPU Traffic</span>
              <span class="info-box-number">90<small>%</small></span>
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
          <h3 class="box-title">Statistik Jumlah Korban Kecelakaan</h3>
        </div>
        <div class="box-body">

        </div>
      </div>
    </div>
  </div>
@stop


@section('js')
    <script> console.log('Hi!'); </script>
    <script src="{{ asset('js/Chart.bundle.min.js') }}" charset="utf-8"></script>
    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Sleman", "Bantul", "Kota Madya", "Kulon Progo", "Gunungkidul"],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2],
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
    </script>
@stop
