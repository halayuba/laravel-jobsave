
<script src="{{ asset('js/vue.js') }}"></script>
<script src="{{ asset('js/vue_custom.js') }}"></script>
<script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
<script src="{{--asset('js/jquery-ui.min.js')--}}"></script>
<script src="{{asset('js/jquery_custom.js')}}"></script>
<!-- IMPORTED FROM ASSAN -->
<script type="text/javascript" src="{{asset('vendor/assan/plugins/plugins.js')}}"></script>

<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function () {

  // Get all "navbar-burger" elements
  var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-item'), 0);

  // Check if there are any nav burgers
  if ($navbarBurgers.length > 0) {

    // Add a click event on each of them
    $navbarBurgers.forEach(function ($el) {
      $el.addEventListener('click', function () {

        // Get the target from the "data-target" attribute
        var target = $el.dataset.navMenu;
        var $target = document.getElementById(navMenu);

        // Toggle the class on both the "navbar-burger" and the "navbar-menu"
        $el.classList.toggle('is-active');
        $target.classList.toggle('is-active');

      });
    });
  }

  });
</script>

@yield('js_file')
