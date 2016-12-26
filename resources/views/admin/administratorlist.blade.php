@extends('adminlte::page')

@section('title', 'Profile Administrator')


@section('content_header')
    <h1>Moderasi Administrator</h1>
@stop

@section('content')
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-danger">
          <table class="table">
            <thead>
              <tr>
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th></th>
                </tr>
              </tr>
            </thead>
            <tbody>
              @foreach ($admin as $user)
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <form action="{{ route('admin.new', ['id' => $user->id ]) }}" method="post">
                    <td>
                      {{ CSRF_field() }}
                      <select class="form-control" name="role" data-id="{{ $user->id }}">
                        <option value="{{ $user->role }}">{{ $user->role }}</option>
                        <option disabled="true">---</option>
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                      </select>
                    </td>
                    <td>
                      <button type="submit" class="btn bg-green"><i class="fa fa-check"></i>Simpan</button>
                    </td>
                  </form>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Administrator</h3>
        </div>
        <div class="box-body">
          <table class="table table-user">
            <thead>
              <tr>
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Ubah Role</th>
                  <th></th>
                </tr>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <form action="{{ route('admin.new', ['id' => $user->id ]) }}" method="post">
                    <td>
                      {{ CSRF_field() }}
                      <select class="form-control" name="role" data-id="{{ $user->id }}">
                        <option value="{{ $user->role }}">{{ $user->role }}</option>
                        <option disabled="true">---</option>
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                      </select>
                    </td>
                    <td>
                      <button type="submit" class="btn bg-green"><i class="fa fa-check"></i>Simpan</button>
                    </td>
                  </form>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
  {{-- Modal Tambah Admin --}}

@endsection


@push('js')
  <script type="text/javascript">
    $('.btn-tambah').click(function() {
      $('.modal-tambah-admin').modal();
    });

    $('.table-user').DataTable();
  </script>
@endpush
