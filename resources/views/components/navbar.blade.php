  <nav class="red darken-1">
    <div class="container-fluid">
      <div class="nav-wrapper">
        <a href="/home" class="brand-logo" style="margin-left: 20px;"><img style="margin-top: 10px; height: 40px;" src="{{asset('/img/sisinfolakantas.png')}}" alt=""></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          @if (Auth::check())
            @if (Auth::user()->role == 'admin')
              <li><a href="/administrator">Administrator</a></li>
            @endif
          @endif
          <li><a href="{{ route('laporankejadian') }}">Daftar Laporan</a></li>
          <li><a href="{{ route('logout')}}">Keluar</a></li>
        </ul>
      </div>
    </div>
  </nav>
