@extends('adminlte::page')

@section('title', 'Profile Administrator')


@section('content_header')
    <h1>Profil Administrator</h1>
@stop

@section('content')
  <div class="row">
    <div class="col-sm-6">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Profile</h3>
        </div>
        <div class="box-body">
          <form class="" action="{{ route('admin.post.profile') }}" method="post">
            {{ CSRF_field() }}
            <div class="row form-group">
              <label class="col-sm-2" for="">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{ $user->name }}">

              </div>
            </div>
            <div class="row form-group">
              <label class="col-sm-2" for="">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
              </div>
            </div>
            <div class="row form-group">
              <label class="col-sm-2" for="">Alamat</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="address" value="{{ $user->address }}">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-sm-12 text-right">
                <button type="submit" class="btn btn-primary" name="button">Ubah Profil</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
