@extends('layouts.appmaterial')

@section('title', 'Profil '. $user->name)

@section('css')
  <style media="screen">
    body {
      background: rgb(213, 213, 213);
    }
  </style>
@endsection

@section('content')
  @include('components.navbar')
  <div class="container">
    <div class="row">
      <div class="col s12">
        <h4>Profil - {{ $user->name }}</h4>
        <div class="card-panel white" id="form-edit">

          <form class="" action="{{ route('editprofile') }}" method="post">
            {{CSRF_field()}}
            <div class="row">
              <table class="striped">
                <tr>
                  <td>Nama</td>
                  <td><input type="text" name="name" value="{{ $user->name}}"></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td><input type="email" name="email" value="{{ $user->email }}"></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td><input type="text" name="address" value="{{ $user->address}}" ></td>
                </tr>
              </table>
            </div>
            <div class="row">
              <div class="col s12">
                <button type="submit" class="btn waves" name="button">Simpan</button>
                <a class="btn waves red btn-cancel" >Batal</a>
              </div>
            </div>
          </form>
        </div>

        <div class="card-panel white">
          <p>
            <a href="#" class="btn waves waves-light btn-edit">Edit</a>
          </p>
          <table class="striped">
            <tr>
              <td>Nama</td>
              <td>{{ $user->name}}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>{{ $user->email}}</td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>{{ $user->address}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>

  </div>
@endsection

@section('js')
  <script type="text/javascript">
    $('#form-edit').hide();
    $('.btn-cancel').click(function() {
      $('#form-edit').slideUp(400);
    });

    $('.btn-edit').click(function() {
      $('#form-edit').slideDown('400');
    });
  </script>
@endsection
