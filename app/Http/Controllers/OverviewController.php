<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;

class overviewController extends Controller
{
    public function overview()
    {
       //== JOBS WITH UPCOMING INTERVIEWS
     //====================
     $jobsWithUpcomingInterviews = Job::upcomingInterviewsWithSort()->get();
    //  $jobsWithUpcomingInterviews = Job::hasInterviews()->with(['employer', 'application', 'interviews'])->get();

       //== JOBS WITH PAST INTERVIEWS
     //====================
     $jobsWithPastInterviews = Job::oldInterviewsWithSort()->get();
    //  $jobsWithPastInterviews = Job::oldInterviews()->with(['employer', 'application', 'interviews'])->get();

       //== SUBMITTED APPLICATIONS WITH NO INTERVIEWS
     //====================
      $jobsWithNoInterviews = Job::submittedApplicationsWithNoInterviews();
      // $jobs = Job::applicationChain()->get();
      // $jobs = Job::hasApplication()->with(['employer', 'application', 'interviews'])->get();

      $jobsWithNoSuccess = NULL;

      return view('overviews.overview', compact('jobsWithUpcomingInterviews', 'jobsWithPastInterviews', 'jobsWithNoInterviews', 'jobsWithNoSuccess'));
    }

    public function upcoming(Job $job)
    {
      $jobsWithUpcomingInterviews = Job::upcomingInterviewsWithSort()->get();
      // $jobs = $job->hasInterviews()->with(['employer', 'application', 'interviews'])->get();
      $jobsWithPastInterviews = $jobsWithNoInterviews = $jobsWithNoSuccess = NULL;
      return view('overviews.overview', compact('jobsWithUpcomingInterviews', 'jobsWithPastInterviews', 'jobsWithNoInterviews', 'jobsWithNoSuccess'));
    }

    public function old(Job $job)
    {
      $jobsWithPastInterviews = Job::oldInterviewsWithSort()->get();
      // $jobs = $job->oldInterviews()->with(['employer', 'application', 'interviews'])->get();
      $jobsWithUpcomingInterviews = $jobsWithNoInterviews = $jobsWithNoSuccess = NULL;
      return view('overviews.overview', compact('jobsWithPastInterviews', 'jobsWithUpcomingInterviews', 'jobsWithNoInterviews', 'jobsWithNoSuccess'));
    }

    // public function noInterviews(Job $job)
    // {
    //   $jobsWithNoInterviews = Job::submittedApplicationsWithNoInterviews();
    //   $jobsWithUpcomingInterviews = $jobsWithPastInterviews = NULL;
    //   return view('overviews.overview', compact('jobsWithNoInterviews', 'jobsWithUpcomingInterviews', 'jobsWithPastInterviews'));
    // }

    public function noSuccess(Job $job)
    {
      $jobsWithNoSuccess = Job::unsuccessfulApplications()->get();
      $jobsWithUpcomingInterviews = $jobsWithNoInterviews = $jobsWithPastInterviews = NULL;
      return view('overviews.overview', compact('jobsWithNoSuccess', 'jobsWithUpcomingInterviews', 'jobsWithPastInterviews', 'jobsWithNoInterviews'));
    }
}
