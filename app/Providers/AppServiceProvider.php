<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer(['employers.create', 'employers.edit'], function($view)
      {
        $view->with('industries', \App\Industry::all());
      });

      view()->composer(['jobs.create', 'jobs.edit', 'jobs.createSpecific'], function($view)
      {
        $venues = \App\Venue::all();
        $employment_types = \App\Employment_type::all();
        $employers = \App\Employer::owns()->current()->get();
        $view->with(compact('venues', 'employment_types', 'employers'));
      });

      view()->composer(['applications.create', 'applications.edit'], function($view)
      {
        $resumes = \App\Resume::owns()->get();
        $view->with(compact('resumes'));
      });

      view()->composer(['interviews.create', 'interviews.edit'], function($view)
      {
        $interview_types = \App\Interview_type::all();
        $view->with(compact('interview_types'));
      });

      ///== HEADER >> UPCOMING INTERVIEWS ICON
      //====================
      view()->composer(['pages.overview', 'layouts.partials.header'], function($view)
      {
        $upcoming_interviews = \App\Interview::upcomingInterviewsIcon()->count();
        $view->with(compact('upcoming_interviews'));
      });

      ///== HEADER >> OFFERS ICON
      //====================
      view()->composer(['pages.overview', 'layouts.partials.header'], function($view)
      {
        $offers = \App\Offer::offersIcon()->count();
        $view->with(compact('offers'));
      });

      view()->composer('pages.overview', 'App\Http\ViewComposers\OverviewFilters@defaultView');

         //== CUSTOM BLADE
       //====================
       \Blade::if('resumeExists', function(){
         return \App\Resume::owns()->count() > 0;
       });

       ///== APPLICATION >> INDEX >> INTERVIEW BUTTON
       //====================
       \Blade::if('interviewBtn', function($check1, $check2, $id){
          if($check1 || $check2) return false;
          return createInterviewButton($id);

          ///== BELOW WORKS FINE BUT PRODUCES 17 QUERIES AS OPPOSED TO ONLY 10 BY ABOVE
          //====================
          //  if($check1 || $check2) return false;
          //  else
          //  {
          //    $job = \App\Job::find($id);
          //    return $job->btn_for_interview();
          //  }
       });

       \Blade::if('deleteButton', function($model){
         return !$model->inUse();
       });

       \Blade::if('deleteApplication', function($application){
         return !$application->isInUse() || !$application->pastUse();
       });

       \Blade::if('downloadButton', function($model){
         return !$model->hasNoUpload();
       });

       \Blade::if('activeButton', function($check){
         return !$check;
       });

       \Blade::if('isTrue', function($check){
         return $check;
       });

       // INTERVIEW >> JOBLIST
       \Blade::if('appWithUpcomingInterview', function($id){
         $job = \App\Job::find($id);
         return $job->jobHasUpcomingInterview();
       });

       // INTERVIEW >> JOBLIST
       \Blade::if('appWithPastInterview', function($id){
         $job = \App\Job::find($id);
         return $job->jobHadPastInterview();
       });

       // INTERVIEW >> JOBLIST
       \Blade::if('appWithNoInterview', function($id){
         $job = \App\Job::find($id);
         return $job->interviews->count();
       });

       // INTERVIEW >> ACTION BUTTONS >> btnCanceled
       \Blade::if('btnCanceled', function($interview){
         return !$interview->is_canceled && !$interview->is_unsuccessful && on_or_after($interview->date);
       });

       // INTERVIEW >> ACTION BUTTONS >> Unsuccessful
       \Blade::if('btnUnsuccessful', function($interview){
         return !$interview->is_canceled && !$interview->is_unsuccessful && on_or_before($interview->date);
       });

       \Blade::if('image', function($image){
         return $image['is_image'];
       });

       \Blade::if('download', function($image){
         return $image['is_download'];
       });

       \Blade::if('strlenUrl', function($url){
         $url = str_after($url, 'http://');
         $url = str_after($url, 'https://');
         return strlen($url)<=30;
       });

       ///== OVERVIEW >> _NOSUCCESS FILTER
       //====================
       \Blade::if('jobWithInterview', function($model){
         return (isset($model) && $model->isNotEmpty());
       });

       ///== JOBS: SUBMITTED && NOT CLOSED
       //====================
       \Blade::if('jobSubmittedNotClosed', function($job){
         return ($job->has_submitted && !$job->has_closed);
       });

       ///== JOBS: NOT SUBMITTED && NOT CLOSED
       //====================
       \Blade::if('jobNotSubmittedNotClosed', function($job){
         return (!$job->has_submitted && !$job->has_closed);
       });

       ///== JOBS: SUBMITTED OR CLOSED
       //====================
       \Blade::if('jobSubmittedClosed', function($job){
         return ($job->has_submitted || $job->has_closed);
       });

       ///== INTERVIEWS: ZOOMING ON OFFERS SIMILAR TO interviewsWithPotentialOffers
       //====================
       \Blade::if('offers', function($interview){
         if(!$interview->is_canceled && !$interview->is_unsuccessful && $interview->date < current_date())
         {
           if(!$interview->job->offer) return true;
         }
         return false;
       });

       ///== OFFER >> INDEX >> ACTION >> statusUpdateAccept
       //====================
       \Blade::if('btnAcceptOffer', function($offer){
         return $offer->confirmJobNotClosed();
       });

       ///== OFFER >> INDEX >> ACTION >> statusUpdateReject
       //====================
       \Blade::if('btnRejectOffer', function($offer){
         return $offer->btnRejectOffer();
       });

/* //====================
 //== SHOWING THE FILTER SECTION IN INDEX PAGES
//==================== */

       ///== FILTERS >> EMPLOYER INDEX
       //====================
       \Blade::if('employers_count', function(){
         return \App\Employer::count() > 0;
       });

       ///== FILTERS >> Job INDEX
       //====================
       \Blade::if('jobs_count', function(){
         return \App\Job::count() > 0;
       });

       ///== FILTERS >> Application INDEX
       //====================
       \Blade::if('applications_count', function(){
         return \App\Application::count() > 0;
       });

       ///== FILTERS >> Interview INDEX
       //====================
       \Blade::if('interviews_count', function(){
         return \App\Interview::count() > 0;
       });

       ///== FILTERS >> Offer INDEX
       //====================
       \Blade::if('offers_count', function(){
         return \App\Offer::count() > 0;
       });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
