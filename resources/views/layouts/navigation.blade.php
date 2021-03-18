<nav class="bg-white shadow-sm">
  <div class="flex justify-between items-center px-6 py-4">

    <!-- LOGO -->
    <div class="flex-shrink-0 flex items-center">
      <a href="{{ route('home') }}" class="w-32 h-auto fill-current inline-block">
        <x-application-logo />
      </a>
    </div>

    <!-- NAV MENU ITEMS -->
    <div class="hidden sm:flex items-center">

      <x-nav-link route="home">Home</x-nav-link>
      <x-nav-link route="submissions">Submissions</x-nav-link>
      <x-nav-link route="interviews">Interviews</x-nav-link>

    </div> <!-- NAV MENU ITEMS -->

    <div class="">
      <!-- MOBILE NAV COMPONENT -->
      <div class="sm:hidden">
        <mobile-nav>
          <x-mobile-nav-link route="home">Home</x-mobile-nav-link>
          <x-mobile-nav-link route="submissions">Submissions</x-mobile-nav-link>
          <x-mobile-nav-link route="interviews">Interviews</x-mobile-nav-link>
        </mobile-nav>
      </div>

      <!-- AUTH / GUEST -->
      <div class="hidden sm:block">
        @guest
          <x-nav-link route="login">Login</x-nav-link>
          <x-nav-link route="register">Register</x-nav-link>
        @else

          <!-- VUE COMPONENT -->
          <dropdown align="right" width="100px">
            <template v-slot:trigger>
              <div class="flex items-center">

                <!-- AVATAR & NAME OF SIGNED IN USER -->
                <button type="button" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">

                  <img src="{{ auth()->user()->avatar() }}" alt="" class="w-8 h-8 rounded-full mr-4">

                  {{ Auth::user()->name }}

                  <picture class="w-4 h-3 fill-current inline-block ml-1">
                    <x-svg.icons type="chevron3" />
                  </picture>
                </button>

              </div>
            </template>

            <!-- PROFILE -->
            <x-dropdown-link :href="route('home')">
              Profile
            </x-dropdown-link>

            <!-- LOG OUT -->
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <x-dropdown-link :href="route('logout')"
                      onclick="event.preventDefault();
                                  this.closest('form').submit();">
                {{ __('Log out') }}
              </x-dropdown-link>
            </form>
          </dropdown> <!-- VUE COMPONENT -->

        @endguest
      </div>
    </div>
  </div>
</nav>
