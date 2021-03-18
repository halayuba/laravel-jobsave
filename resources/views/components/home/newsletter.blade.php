<!--   //====================
     //== NEWSLETTER
   //==================== -->
<div class="w-full py-24 relative">

  <div class="bg-gray-300 max-w-3xl text-center relative z-20 mx-auto py-6 opacity-75">

     <!-- ALERT MESSAGES -->

    <h3 class="font_family_berkshire text-2xl md:text-5xl text-gray-800 leading-relaxed tracking-widest mb-4">Join the newsletter</h3>

    <div class="container mx-auto px-4 xl:px-12 flex justify-center">
      <picture class="w-16 h-auto inline-block">
        <img src="{{ asset('images/me.jpg') }}" alt="Simon">
      </picture>
      <div class="flex-1 ml-2 xl:ml-4 text-left">
        <p class="text-gray-700">If you're interested in receiving updates on the latest development then please sign up so you can get details about all new upcoming features.</p>
        <p class="mt-4 text-sm text-green-700 font-light flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current text-green-700 inline-block mr-1"><path d="M17 8v1H0V8h17z"/></svg>
          Simon Bashir, creator of jobsave
        </p>
      </div>
    </div>

    <form class="mt-6 flex w-full max-w-xs mx-auto" method="POST" action="{{ route('newsletter') }}">
      @csrf
      <!-- EMAIL -->
      <div class="relative flex-1">
        <span class="absolute inset-y-0 left-0 flex items-center pl-2">
          <picture class="w-4 h-4 inline-block text-gray-600 fill-current">
            <x-svg.icons type="envelope" />
          </picture>
        </span>
        <input name="email" type="email" placeholder="Email address" class="h-12 bg-gray-100 text-sm text-gray-800 focus:outline-none px-8 py-2">
      </div>

      <button class="h-12 w-24 bg-gray-900 text-white text-sm uppercase" type="submit">Join</button>

    </form>
  </div>

  <img src="https://images.unsplash.com/photo-1554412664-6a4d8f640b3b?w=1800" class="absolute top-0 left-0 w-full h-full object-cover z-10 " />

</div>
