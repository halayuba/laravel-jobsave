<!--   //====================
     //== FEATURES
   //==================== -->

<!-- OUTER WRAPPER -->
<div class="w-full flex flex-col justify-center py-4 xl:py-8">

  <x-home.banner svg="features">Features</x-home.banner>

  <!-- DETAILS -->
  <div class="bg-gray-100 px-12 py-8 xl:py-16">
    <div class="container mx-auto">

      <div class="w-full grid grid-cols-1 lg:grid-cols-2 lg:gap-2">

        <!-- Simple Dashboard -->
        <div class="flex flex-col xm:flex-row items-center">
          <x-svg.banners type="dashboard" />
          <div class="pl-5">
            <h4 class="font_family_nunito text-base md:text-lg text-gray-900 leading-tight mb-2">Simple Dashboard</h4>
            <p class="text-xs md:text-sm text-gray-700 leading-snug max-w-sm">
              You have full control of the entire process. We present you with a very simple <a href="{{ asset('workflow') }}" class="no-underline">workflow</a> to follow but the rest is all up to you. You decide what to add as per your requirements. At the end, you are tracking what you feel is important to you!
            </p>
          </div>
        </div>

        <!-- Concise Overview -->
        <div class="flex flex-col xm:flex-row items-center mt-8">
          <x-svg.banners type="overview" />
          <div class="pl-5">
            <h4 class="font_family_nunito text-base md:text-lg text-gray-900 leading-tight mb-2">Concise Overview</h4>
            <p class="text-xs md:text-sm text-gray-700 leading-snug max-w-sm">
              This is where you'll get a summary of the most important information that you have been feeding the system with about Employers, Jobs, Submitted Applications, Interviews, etc.
            </p>
          </div>
        </div>

        <!-- Emphasis on Functionality -->
        <div class="flex flex-col xm:flex-row items-center mt-8">
          <x-svg.banners type="functionality" />
          <div class="pl-5">
            <h4 class="font_family_nunito text-base md:text-lg text-gray-900 leading-tight mb-2">Emphasis on Functionality</h4>
            <p class="text-xs md:text-sm text-gray-700 leading-snug max-w-sm">
              The design is basic and simple because the focus is primarily on the functionality. We'd rather have you stay on target and empower you with the essentials tools that will allow you to manage job hunting with minimal effort.
            </p>
          </div>
        </div>

        <!-- Features -->
        <div class="flex flex-col xm:flex-row items-center mt-8">
          <x-svg.banners type="ideas" />
          <div class="pl-5">
            <h4 class="font_family_nunito text-base md:text-lg text-gray-900 leading-tight mb-2">Features</h4>
            <p class="text-xs md:text-sm text-gray-700 leading-snug max-w-sm">
              New features will be added soon so come back and check us out again. We are currently working on additional features that we hope could add value and productivity to your job search.
            </p>
          </div>
        </div>

      </div>

    </div>
  </div>

</div>