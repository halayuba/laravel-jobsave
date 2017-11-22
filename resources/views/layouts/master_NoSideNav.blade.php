<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  @include('layouts.partials.head')
</head>
<body>
    <div id="wrapper">
      @include('layouts.partials.header')

      @yield('ads')

      @yield('hero')

      @include('layouts.partials.alerts')

      @yield('content')

    </div>

      @include('layouts.partials.footer')

      @include('layouts.partials.scripts')
</body>
</html>
