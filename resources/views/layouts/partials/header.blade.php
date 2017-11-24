<nav class="navbar">
  <div class="navbar-brand">
    <a class="navbar-item is-tab" href="http://jobsave.io">
      <img src="{{ asset('img/logo.png') }}" alt="Job Save" width="192" height="70">
    </a>
  </div>

  <button class="button navbar-burger" data-target="navMenu">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <div class="navbar-menu" id="navMenu">
    <div class="navbar-start">
      <a href="{{ url('dashboard') }}" class="navbar-item is-tab {{ current_page('dashboard') }}">Dashboard</a>
      <a href="{{ url('overview') }}" class="navbar-item is-tab {{ current_page('overview') }}">Overview</a>
    </div>

    <div class="navbar-end">
      @guest
        <a href="{{ route('login') }}" class="navbar-item is-tab">
          log in
        </a>
        <a href="{{ route('register') }}" class="navbar-item is-tab">
          register
        </a>
      @else
        @if($upcoming_interviews > 0)
          <a href="{{ route('overview.upcoming-interviews') }}" class="">
            <span class="icon is-big"><i class="fa fa-bullhorn css_icon"></i></span>
            <span class="tag is-success">{{ $upcoming_interviews }}</span>
          </a>
        @endif
        @if($offers > 0)
          <a href="{{ url('/offers') }}" class="mgl_1">
            <span class="icon is-big"><i class="fa fa-trophy css_icon"></i></span>
            <span class="tag is-success">{{ $offers }}</span>
          </a>
        @endif
        <a href="#" class="navbar-item is-tab">
          <span class="icon"><i class="fa fa-user-o"></i></span>
          {{ Auth::user()->name }}
        </a>
        <a href="#" class="navbar-item is-tab"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"
        >
          Logout
        </a>
      @endguest
    </div>
  </div>

</nav>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="is-hidden">
  {{ csrf_field() }}
</form>
