<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="{{ asset('/css/materialize.min.css') }}"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="{{ asset('/css/style.css') }}"  media="screen,projection"/>

      <title>@yield('title')</title>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      @yield('css')
    </head>

    <body>
      @yield('content')
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="{{ asset('/js/jquery.js') }} "></script>
      <script type="text/javascript" src="{{ asset('/js/materialize.min.js') }} "></script>

      @yield('js')
    </body>
  </html>
