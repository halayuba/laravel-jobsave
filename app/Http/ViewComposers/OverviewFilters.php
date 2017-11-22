<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Carbon\Carbon;

class OverviewFilters
{

  /* //====================
    //== COMPONENETS FOR THE OVERVIEW PAGE
   //==================== */
  public function defaultView(View $view)
  {
    $resumes = \App\Resume::owns()->count();
    $submitted_applications = \App\Application::submitted()->count();
    $pending_applications = \App\Application::pending()->count();
    $completed_interviews = \App\Interview::completed()->count();
    $offers = \App\Offer::count();

    ///== Number of applications submitted this week
    //====================
    $applications_week = \App\Application::submittedDuringLastWeek()->count();

    ///== APPLICATION LAST SUBMISSION DATE
    //====================
    $app = \App\Application::submitted()->latest('submitted_on')->first();
    $app_last_date = $app? $app->submitted_on->toFormattedDateString() : '';

    $view->with(compact('resumes', 'submitted_applications', 'pending_applications', 'completed_interviews', 'offers', 'applications_week', 'app_last_date'));
  }

}
