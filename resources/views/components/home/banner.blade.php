@props(['svg'])

<!-- BANNER -->
<div class="w-full bg-gray-700 md:bg-gray-200 mt-4 xl:mt-12 md:py-4">

  <div class="w-full flex flex-col-reverse md:flex-row md:justify-center md:items-center pb-12 md:pb-0 md:py-4">

    <!-- ILLUSTRATION -->
    <div class="bg-gray-100 md:bg-transparent text-center py-4 md:py-0 md:rounded-lg md:flex md:justify-center md:flex-1">
      <picture class="w-64 h-auto inline-block" >

        <x-svg.banners type="{{ $svg }}" />
      </picture>
    </div>

    <div class="md:flex-1 md:h-48 mt-8 md:mt-0 relative flex flex-col lg:flex-row justify-center items-center px-2 xl:px-6 text-center md:mr-4">
      <!-- BACKGROUND BANNER -->
      <img src="{{ asset('images/banners/banner-2.jpg') }}" class="absolute top-0 left-0 w-full h-full object-cover opacity-75" />

      <h1 class="font_family_berkshire text-5xl text-white md:text-gray-800 leading-relaxed tracking-widest">
        {{ $slot }}
      </h1>
    </div>

  </div>

</div> <!-- BANNER -->
