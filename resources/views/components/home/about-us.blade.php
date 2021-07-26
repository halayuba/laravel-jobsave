<!--   //====================
     //== WHAT IS JOB SAVE
   //==================== -->
<div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-16 xl:py-32">

  <div class="container mx-auto flex flex-col xl:flex-row">

    <!-- LEFT: PIC -->
    <div class="w-full xl:w-1/3 flex justify-center items-center xl:items-start mb-12 xl:mb-0">
      <picture class="flex-initial">
        <img src="{{ asset('images/banners/aboutus-300.png') }}" alt="find a job banner" class="">
      </picture>
    </div>

    <!-- RIGHT -->
    <div class="w-full xl:w-2/3 px-8 xl:px-12">

      <!-- HEADER -->
      <h1 class="font_family_berkshire text-3xl md:text-5xl text-gray-800 leading-relaxed tracking-widest">What is Job Save</h1>

      <p class="mt-12 text-sm md:text-lg xl:text-xl text-gray-600 leading-normal">Job Save has a simple aim which is to help you manage your job search activities more <strong>effectively</strong> and to give you an <strong>extended overview</strong> of all important information, dates, events, and actions related to your endeavours.</p>
      <p class="mt-12 text-sm md:text-lg xl:text-xl text-gray-600 leading-normal">Presumably, with <strong>several</strong> application submissions on a daily basis, the entire process of keeping track could quickly become tedious and even <strong>overwhelming</strong>. Job Save is a tool that will <strong>help you track</strong> many aspects of this intense undertaking, particularly, keeping records about companies &amp; jobs you've been applying for, statuses of your job applications, upcoming scheduled interviews, etc.</p>

      <div class="flex flex-col mt-20">
        <!-- BUTTON -->
        <a href="{{ route('register') }}" class="bg-green-800 hover:bg-green-700 text-white py-4 w-full rounded hover:shadow-sm text-center">Try it - It's Free</a>

        <!-- DIVIDER -->
        <div class="px-2 py-8 flex">
          <div class="flex-1 my-3 border-b border-logo"></div>
          <div class="flex-1 text-center px-4">or</div>
          <div class="flex-1 my-3 border-b border-logo"></div>
        </div>

        <!-- BUTTON -->
        <a href="https://github.com/halayuba/laravel-jobsave.git" class="bg-gray-600 hover:bg-gray-500 text-white py-4 w-full rounded hover:shadow-sm text-center">Visit Github</a>
      </div>

    </div>
  </div>

</div>