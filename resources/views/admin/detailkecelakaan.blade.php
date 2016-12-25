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
          <h3 class="box-title">Peta Kejadian</h3>
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
          <h3 class="box-title"><i class="fa fa-car"></i> Kendaraan</h3>
        </div>
        <div class="box-body">
          <table class="table">
            <thead>
              <tr>
                <th>Plat Nomor</th>
                <th>Tipe Kendaraan</th>
                <th>Merk</th>
                <th>Warna</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($kejadian->kendaraan as $kendaraan)
                <tr>
                  <td>{{ $kendaraan->platnomor }}</td>
                  <td>{{ $kendaraan->tipe_kendaraan }}</td>
                  <td>{{ $kendaraan->merk }}</td>
                  <td>{{ $kendaraan->warna }}</td>
                  <td>
                    <a href="#" data-id="{{ $kendaraan->id }}" data-plat="{{ $kendaraan->platnomor }}" data-tipe="{{ $kendaraan->tipe_kendaraan }}" data-merk="{{ $kendaraan->merk }}" data-warna="{{ $kendaraan->warna }}" class="btn btn-warning edit-kendaraan-btn"><i class="fa fa-pencil"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- Tambah Kendaraan --}}
    <div class="col-sm-6">
      <div class="box box-danger">
        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-car"></i> Tambah Kendaraan</h3>
          <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
        </div>
        <div class="box-body">
          <form action="{{ route('tambahkendaraan', ['id' => $kejadian->id] )}}" method="post">
          <div class="modal-body">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="row form-group">
                <label for="in-merk-form" class="col-md-3 label-control">Merk: </label>
                <div class="col-sm-9">
                  <input id="in-merk-form" class="form-control" type="text" name="merk">
                </div>
              </div>
              <div class="row form-group">
                <label for="in-palt-form" class="col-md-3 label-control">Plat nomor: </label>
                <div class="col-sm-9">
                  <input id="in-palt-form" class="form-control" type="text" name="platnomor">
                </div>
              </div>
              <div class="row form-group">
                <label for="in-warna-form" class="col-md-3 label-control">Warna: </label>
                <div class="col-sm-9">
                  <input id="in-warna-form" class="form-control" type="text" name="warna">
                </div>
              </div>
              <div class="row form-group">
                <label for="in-tipe-form" class="col-md-3 label-control">Tipe: </label>
                <div class="col-sm-9">
                  <select id="in-tipe-form" name="kendaraan" class="form-control">
                    <option value="" disabled="" selected="">Pilih Tipe Kendaraan</option>
                    <option value="Sepeda Motor">Sepeda Motor</option>
                    <option value="Mobil">Mobil</option>
                    <option value="Bus">Bus</option>
                    <option value="Truk Sedang">Truk Sedang</option>
                    <option value="Truk Berat">Truk Berat</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>
              </div>

          </div>
          <div class="text-right">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>

  {{-- List Korban --}}
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-warning">
        <div class="box-header">
          <h3 class="box-title"><i class="fa fa-child"></i> Korban</h3>
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
              @php
                $i=1;
              @endphp
              @foreach ($kejadian->korban as $korban)
                <tr>
                  <td>{{$i++}}</td>
                  <td>{{ $korban->nama }}</td>
                  <td>{{ $korban->jenis_kelamin }}</td>
                  <td>{{ $korban->umur }} tahun</td>
                  <td>{{ $korban->kondisi }}</td>
                  @if ($korban->kendaraan_id != 0)
                    <td>{{ $korban->kendaraan->merk . " (". $korban->kendaraan->platnomor .")" }}</td>
                  @else
                    <td>Tidak Berkendara</td>
                  @endif
                  <td>
                    <a href="#" data-id="{{ $korban->id }}" data-nama="{{ $korban->nama }}" data-kendaraan="{{ $korban->kendaraan_id }}" data-umur="{{ $korban->umur }}" data-kondisi="{{ $korban->kondisi }}" data-gender="{{ $korban->jenis_kelamin }}" class="edit-korban-btn btn btn-warning"><i class="fa fa-pencil"></i></a>
                    <a href="#" data-id="{{ $korban->id }}" class="hapus-korban-btn btn btn-danger"><i class="fa fa-remove"></i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- Tambah Korban --}}
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-warning">
        <div class="box-header wih border">
          <h3 class="box-title"><i class="fa fa-plus"></i> Tambah Korban</h3>
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
            <form class="" action="{{ route('postkorban', ['id' => $kejadian->id]) }}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <tr>
                <td>
                  <input class="form-control" type="text" name="nama" value="">
                </td>
                <td>
                  <select class="form-control" name="jenis_kelamin">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                  </select>
                </td>
                <td>
                  <input class="form-control" type="number" name="umur" value="">
                </td>
                <td>
                  <input class="form-control" type="text" name="kondisi" value="">
                </td>
                <td>
                  <select class="form-control" name="kendaraan">
                    <option value="0">Tidak Berkendaraan</option>
                    @foreach ($kejadian->kendaraan as $kendaraan)
                      <option value="{{ $kendaraan->id }}">{{ $kendaraan->merk }} - {{ $kendaraan->platnomor }}</option>
                    @endforeach
                  </select>
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

  {{-- Modal Edit Kendaraan --}}
  <div class="modal-edit-kendaraan modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="fa fa-car"></i> Edit Kendaraan</h4>
        </div>
        <form id="editvehicleform" action="index.html" method="post">
        <div class="modal-body">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="row form-group">
              <label for="merk-form" class="col-md-3 label-control">Merk: </label>
              <div class="col-sm-9">
                <input id="merk-form" class="form-control" type="text" name="merk">
              </div>
            </div>
            <div class="row form-group">
              <label for="palt-form" class="col-md-3 label-control">Plat nomor: </label>
              <div class="col-sm-9">
                <input id="palt-form" class="form-control" type="text" name="platnomor">
              </div>
            </div>
            <div class="row form-group">
              <label for="warna-form" class="col-md-3 label-control">Warna: </label>
              <div class="col-sm-9">
                <input id="warna-form" class="form-control" type="text" name="warna">
              </div>
            </div>
            <div class="row form-group">
              <label for="tipe-form" class="col-md-3 label-control">Tipe: </label>
              <div class="col-sm-9">
                <select id="tipe-form" name="kendaraan" class="form-control">
                  <option value="" disabled="" selected="">Pilih Tipe Kendaraan</option>
                  <option value="Sepeda Motor">Sepeda Motor</option>
                  <option value="Mobil">Mobil</option>
                  <option value="Bus">Bus</option>
                  <option value="Truk Sedang">Truk Sedang</option>
                  <option value="Truk Berat">Truk Berat</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        </div>
      </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  {{-- Modal Edit Korban --}}
  <div class="modal-edit-korban modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="fa fa-child"></i> Edit Korban</h4>
        </div>
        <form id="editvictimform" action="index.html" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="modal-body">
            <div class="row form-group">
              <label for="nama-form" class="col-md-3 label-control">Nama: </label>
              <div class="col-sm-9">
                <input id="nama-form" class="form-control" type="text" name="nama">
              </div>
            </div>

            <div class="row form-group">
              <label for="gender-form" class="col-md-3 label-control">Jenis Kelamin: </label>
              <div class="col-sm-9">
                <select id="gender-form" class="form-control" name="jenis_kelamin">
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
            </div>

            <div class="row form-group">
              <label for="umur-form" class="col-md-3 label-control">Umur: </label>
              <div class="col-sm-9">
                <input id="umur-form" class="form-control" type="number" name="umur">
              </div>
            </div>

            <div class="row form-group">
              <label for="kondisi-form" class="col-md-3 label-control">Kondisi: </label>
              <div class="col-sm-9">
                <input id="kondisi-form" class="form-control" type="text" name="kondisi">
              </div>
            </div>

            <div class="row form-group">
              <label for="kendaraan-form" class="col-md-3 label-control">Kendaraan: </label>
              <div class="col-sm-9">
                <select id="kendaraan-form" class="form-control" name="kendaraan">
                  <option value="0">Tidak Berkendaraan</option>
                  @foreach ($kejadian->kendaraan as $kendaraan)
                    <option value="{{ $kendaraan->id }}">{{ $kendaraan->merk }} - {{ $kendaraan->platnomor }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batalkan</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  {{-- Modal Hapus Korban --}}
  <div class="modal-hapus-korban modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><i class="fa fa-child"></i> Hapus Korban</h4>
        </div>
          <div class="modal-body">
            Apakah anda yakin akan menghapus <b></b>?
          </div>
          <div class="modal-footer">
            <a href="#" class="btn btn bg-green">Tidak</a>
            <a href="#" class="confirm-hapus-korban btn btn bg-red">Ya</a>
          </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

@stop

@section('js')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDRijsRVPPetZDnC3tCInbEO-uZ6hLiUeI"></script>
  {{-- Modal Script --}}
  <script type="text/javascript">
  $(document).ready(function() {
    // Edit Kendaraan
    $('.edit-kendaraan-btn').click(function() {
      var id = $(this).data('id');
      var plat = $(this).data('plat');
      var tipe_kendaraan = $(this).data('tipe');
      var merk = $(this).data('merk');
      var warna = $(this).data('warna');
      $('#merk-form').val(merk);
      $('#palt-form').val(plat);
      $('#warna-form').val(warna);
      $('#tipe-form').val(tipe_kendaraan);
      $('#editvehicleform').attr('action', '/administrator/editkendaraan/'+id);
      $('.modal-edit-kendaraan').modal();
    });

    //Edit Korban
    $('.edit-korban-btn').click(function() {
      var id = $(this).data('id');
      var jeniskelamin = $(this).data('gender');
      var nama = $(this).data('nama');
      var umur = $(this).data('umur');
      var kondisi = $(this).data('kondisi');
      var kendaraan = $(this).data('kendaraan');

      $('#nama-form').val(nama);
      $('#gender-form').val(jeniskelamin);
      $('#umur-form').val(umur);
      $('#kondisi-form').val(kondisi);
      $('#kendaraan-form').val(kendaraan);

      $('#editvictimform').attr('action', '/administrator/editkorban/'+id);

      $('.modal-edit-korban').modal();

    });

    //hapus korban
    $('.hapus-korban-btn').click(function() {
      var id = $(this).data('id');
      $('.modal-hapus-korban').modal();
      $('.confirm-hapus-korban').attr('href', '/administrator/hapuskorban/'+id);

    });

  });
  </script>

  <script src="/js/gmaps.js"></script>
  <script>
    $(document).ready(function() {
      var element = ".col-sm-6 .box .box-body #map-thumbnail";
      $(element).html('<h4><i class="fa fa-exclamation-circle"></i> Error Loading Google Maps</h4>');
      var map = new GMaps({
        el: '#map-thumbnail',
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

  @include('sweet::alert')
@endsection
