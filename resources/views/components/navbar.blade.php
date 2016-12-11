<nav class="red darken-1">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">Logo</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        @if (Auth::check())
          @if (Auth::user()->role == 'admin')
            <li><a href="#">Administrator</a></li>
          @endif
        @endif
        <li><a href="#">Daftar Laporan</a></li>
        <li><a href="#">Keluar</a></li>
      </ul>
    </div>
  </nav>
