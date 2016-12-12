@extends('layouts.appmaterial')

@section('title', 'Beranda')

@section('content')
  @include('components.navbar')
  <div class="container-fluid">
    <div class="row boat">
      <div id="map" class="col s12 m8">

      </div>
      <div class="forminput col s12 m4 card">
        <div class="row ">
          <ul class="tabs text-white">
            <li class="tab col s6"><a class="waves-effect waves-light" href="#caribox">Riwayat Kecelakaan</a></li>
            <li class="tab col s6"><a class="active waves-effect waves-light" href="#inputbox">Input Baru</a></li>
          </ul>
        </div>

        {{-- Div Pencarian --}}
        <div id="caribox">
          <form class="" action="index.html" method="post">
            <div class="row">
              <div class="input-field col s8">
                  <input type="date" class="datepicker" value="{{ Carbon\Carbon::now()->format('d F, Y') }}">
              </div>
              <div class="input-field col s4">
                <button type="submit" class="waves-effect waves-light btn red" name="button">Cari</button>
              </div>
            </div>
          </form>
          <ul class="collection">
            @foreach ($kejadian as $kejadiantunggal)
              <li class="collection-item avatar">
                <img src="{{ asset('/img/kecelakaan.png') }}" alt="" class="circle">
                <span class="title">{{$kejadiantunggal->waktu_kejadian->format('M d Y') }}</span>
                <p>{{$kejadiantunggal->kabupaten->nama }}</p>
                <p>{{$kejadiantunggal->sender->name }}</p>
                <p>
                  <a href="{{route('detailkejadian', ['id' => $kejadiantunggal->id])}}">Detail</a>
                </p>
              </li>
            @endforeach
          </ul>
        </div>

        {{-- div masukan data --}}
        <div id="inputbox">
          <form class="" action="{{ url('/addkejadian')}}" method="post">
            {{ csrf_field() }}
            <div class="card">
              <div class="row">
                <h6 class="col s12"><i class="material-icons">place</i> Lokasi</h6>
                <p class="col s12">Klik Lokasi pada maps untuk mendapatkan latitude dan longitude</p>
                <div class="input-field col s6">
                  <label for="latin">Latitude</label>
                  <input id="latin" type="text" name="latitude" value="" placeholder="latitude lokasi kejadian">
                </div>
                <div class="input-field col s6">
                  <label for="longin">Longitude</label>
                  <input id="longin" type="text" name="longitude" value="" placeholder="latitude lokasi kejadian">
                </div>
              </div>

              <div class="row" >
                <div class="col s12" style="margin-bottom: 20px;">
                  <label>Kabupaten</label>
                  <select  name="kabupaten" class="browser-default">
                    <option value="" disabled selected>Pilih Kabupaten</option>
                    <option value="1">Sleman</option>
                    <option value="2">Kota Yogyakarta</option>
                    <option value="3">Bantul</option>
                    <option value="4">Kulon Progo</option>
                    <option value="5">Gunung Kidul</option>
                  </select>
                </div>
              </div>
            </div>

            <h6 class="col s12"><i class="material-icons">directions_car</i> Kendaraan</h6>
            <div class="row" id="addkendaraan">
              <div class="input-field text-left">
                <button type="button" class="addkendaraan waves-effect waves-light btn btn-small">Tambah Kendaraan</button>
              </div>
              <div class="col s12 card">
                <div class="row">

                  <div class="col s12">
                    <label>Tipe Kendaraan</label>
                    <select name="kendaraan[]" class="browser-default">
                      <option value="" disabled selected>Pilih Tipe Kendaraan</option>
                      <option value="Sepeda Motor">Sepeda Motor</option>
                      <option value="Mobil">Mobil</option>
                      <option value="Bus">Bus</option>
                      <option value="Truk Sedang">Truk Sedang</option>
                      <option value="Truk Berat">Truk Berat</option>
                      <option value="Lainnya">Lainnya</option>
                    </select>
                  </div>
                  <div class="input-field col s4">
                    <label for="merkid">Merk: </label>
                      <input type="text" id="merkid" name="merk[]" value="">
                  </div>
                  <div class="input-field col s4">
                    <label for="warnain">Warna: </label>
                    <input type="text" id="warnain" name="warna[]" value="">
                  </div>
                  <div class="input-field col s4">
                    <label for="platid">Plat:: </label>
                    <input type="text" id="platid" name="plat[]" value="">
                  </div>
                </div>
              </div>
            </div>


            <div class="input-field col s12">
              <button class="btn red" type="submit" name="button">Kirim Laporan</button>
            </div>
          </form>
        </div>

      </div>
    </div>

  </div>
@endsection


@section('js')

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRijsRVPPetZDnC3tCInbEO-uZ6hLiUeI"></script>
  <script src="/js/gmaps.js"></script>
  <script type="text/javascript">
    $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15 // Creates a dropdown of 15 years to control year
    });
  </script>
  <script>
    var templat;
    var templang;
    var marker;
    var map = new GMaps({
      el: '#map',
      lat: -7.7710649,
      lng: 110.3865498
    });
    map.addListener('click', function(event) {
      console.log(event.latLng);
      $('#latin').val(event.latLng.lat());
      $('#longin').val(event.latLng.lng());
      if (marker != null) {
        marker.setMap(null);
      }
      marker = map.addMarker({
        lat: event.latLng.lat(),
        lng: event.latLng.lng(),
        infoWindow: {
          content: "<p>Lokasi Kejadian</p>"
        },
        icon : {
          url : "{{ asset('/img/addaccident.png')}}"
        }
      })
    });

    $(document).ready(function() {
      $.ajax({
          type: 'GET',
          url: '//localhost:8000/api/kejadian',
          data: { get_param: 'value' },
          success: function (data) {
              for (var i = 0; i < data.length; i++) {
                map.addMarker({
                  lat: data[i].latitude,
                  lng: data[i].longitude,
                  title: data[i],
                  infoWindow: {
                    content: "<p>"+data[i].waktu_kejadian+"</p>"
                  },
                  icon : {
                    url : "{{ asset('/img/kecelakaan.png')}}"
                  }
                });
                $('#cand').html(data);
              }
          }
      });


    });

    $('.addkendaraan').click(function() {
      var response;
        $.ajax({ type: "GET",
             url: "{{ url('/kompkendaraan') }}",
             async: false,
             success : function(text)
             {
                 response= text;
             }
        });
        $('#addkendaraan').append('<div>'+response+'</div>');
    })

  </script>
@endsection
