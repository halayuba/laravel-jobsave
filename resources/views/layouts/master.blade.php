<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  @include('layouts.partials.head')
</head>
<body>
    <div id="wrapper">
      @include('layouts.partials.header')

      @yield('hero')

      @include('layouts.partials.alerts')

        <div class="section">
          <div class="columns">
              <!--   //====================
                   //== LEFT SIDE: PANEL - DASHBOARD
                 //==================== -->
                <div class="column is-2">
                  @include('layouts.partials.side_nav')
                </div>
              <!--   //====================
                   //== RIGHT SIDE: STATISTICS & MORE
                 //==================== -->
               <div class="column">

                     @yield('content')

               </div>
          </div>
        </div>
    </div>

    @include('layouts.partials.footer')

    @include('layouts.partials.scripts')

</body>
</html>
