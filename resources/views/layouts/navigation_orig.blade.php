<nav class="bg-white ">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex">

          <!-- Logo -->
          <div class="flex-shrink-0 flex items-center">
            <a href="{{ route('home') }}">
              <picture class="w-32 h-auto fill-current inline-block">
                <x-application-logo />
              </picture>
            </a>
          </div>

          <!-- Navigation Links -->
          <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">

            <!-- HOME -->
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
              {{ __('Home') }}
            </x-nav-link>

            <!-- SUBMISSIONS -->
            <x-nav-link :href="route('submissions')" :active="request()->routeIs('submissions')">
              Submissions
            </x-nav-link>

            <!-- INTERVIEWS -->
            <x-nav-link :href="route('interviews')" :active="request()->routeIs('interviews')">
              Interviews
            </x-nav-link>
          </div>
        </div>

        <!-- Settings Dropdown -->
        <div class="hidden sm:flex sm:items-center sm:ml-6">
          @auth
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

              <!-- Authentication -->
              <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                  {{ __('Log out') }}
                </x-dropdown-link>
              </form>
            </dropdown> <!-- VUE COMPONENT -->
          @else
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                Log in
              </x-nav-link>

              @if (Route::has('register'))
                <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                  Register
                </x-nav-link>
              @endif
            </div>
          @endauth
        </div>

        <!-- Hamburger -->
      </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="true">
      <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
          {{ __('Home') }}
        </x-responsive-nav-link>
      </div>

      <!-- Responsive Settings Options -->
      <div class="pt-4 pb-1 border-t border-gray-200">
        <div class="flex items-center px-4">
          <div class="flex-shrink-0">
            <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>

          @auth
            <div class="ml-3">
              <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
              <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
          @else
            <div class="ml-3">
              SB
            </div>
          @endauth
        </div>

        <div class="mt-3 space-y-1">
          @auth
          <!-- Authentication -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
              {{ __('Log out') }}
            </x-responsive-nav-link>
          </form>
          @endauth
        </div>
      </div>
    </div>
</nav>
