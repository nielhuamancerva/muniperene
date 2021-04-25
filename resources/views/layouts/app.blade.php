<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
            @yield('content')
    </div>
    <footer id="sticky-footer" class="py-2 bg-dark text-white">
              <!-- Copyright -->
              <div class="font-weight-bold footer-copyright text-center text-white py-2">&copy;Municipalidad Distrital de Perene - Todos lo derechos reservados
                    <p class="font-weight-bold text-white">Dirección: Jr. 22 de Octubre N° 140 - Perene Teléfono:(064)-544077 - RUC: 20195238961 </p>
              </div>
              <!-- Copyright -->
            </footer>
</body>
</html>
