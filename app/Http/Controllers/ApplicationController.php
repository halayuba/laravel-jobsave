<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Application;
use Gate;

class ApplicationController extends Controller
{

/* //====================
  //== INDEX
 //==================== */
    public function index()
    {
      if(request(['filter']))
      {
        $jobs = Job::applicationFilters(request(['filter']));
      }
      else
      {
        $jobs = Job::query_all_withSort();
      }
      // $jobs = Job::applicationChain()->get();
      // $jobs = Job::owns()->has('application')->with(['employer', 'application'])->get();
      // $jobs = Job::query_job_application_withSort()->owns()->with(['employer', 'application'])->paginate(12);
      return view("applications.index", compact('jobs'));
    }

/* //====================
  //== SHOWS A LIST OF JOBS* TO SELECT FROM TO SUBMIT A JOB APPLICATION TO
 //==================== */
    public function jobList(Job $job)
    {
      $jobs = $job->openJobs()->with('employer')->get();
      return view("applications.jobList", compact('jobs'));
    }

/* //====================
  //== CREATE
 //==================== */
    public function create(Job $job)
    {
      if($job->application)
      {
        return back()->with(flash_message("is-warning", "Can not create another application for the same job!"));
      }
      return view("applications.create", compact('job'));
    }

/* //====================
  //== STORE
 //==================== */
    public function store(Request $request, Job $job)
    {
      request()->validate([
        'submitted_on' => 'required',
        'resume_id' => 'required',
      ]);

      //== VALIDATE DATE NOT IN THE FUTURE: $request->submitted_on
     //====================
      if(Gate::denies('application_date', $job))
      {
        return back()->withInput($request->all())
        ->with(flash_message("is-warning", "There are two reasons for this alert message: One- The application submission date can not precede the date the job was posted on. Second- A future date can not be accepted for submitting a job application!"));
      }

      $application = new Application;
      $application->submitted_on = $request->submitted_on;
      $application->notes = $request->notes;
      $application->has_submitted = ($request->get('has_submitted') == 'on')? true : false;
      $application->has_turned_down = ($request->get('checkbox') == 'on')? true : false;
      $application->resume_id = $request->resume_id;
      $application->user()->associate($request->user());

      if($job->application()->save($application))
      {
         //== UPDATE "HAS_SUBMITTED" IN JOBS TABLE TO TRUE
       //====================
        if($application->has_submitted) $job->makeSubmitted();

        //== UPDATE JOB & INTERVIEWS >> BASED ON THE VALUE OF APPLICATION >> HAS_TURNED_DOWN
       //====================
       if($application->has_turned_down) $this->statusUpdate($application);

        return redirect('applications')->with(flash_message('is-success', 'You have successfully created a new record for an application you have submitted in response to an employment opportunity!'));
      }
    }

/* //====================
  //== SHOW
 //==================== */
    public function show(Job $job)
    {
      return view("applications.show", compact('job'));
    }

/* //====================
  //== EDIT
 //==================== */
    public function edit(Application $application)
    {
      return view("applications.edit", compact('application'));
    }

/* //====================
  //== STATUS UPDATE: IF THE APPLICATION IS REJECTED THEN UPDATED THE STATUS OF ANY PENDING INTERVIEWS TO CANCELED
 //==================== */
    public function statusUpdate(Application $application)
    {
      if($application->archive())
      {
         //== IF THE APPLICATION IS REJECTED THEN UPDATED THE STATUS OF ANY PENDING INTERVIEWS TO CANCELED AND ARCHIVE THE ASSOCIATED JOB
         //====================
         $job = $application->job;
         $job->archive();
         $job->interviews->each->archive();

        return back()->with(flash_message('is-success', 'The status of the selected application has been updated to Rejected.'));
      }
      return back()->withInput($request->all())->with(flash_message('is-danger', 'Update failed. Please try again later!'));
    }

/* //====================
  //== UPDATE
 //==================== */
    public function update(Request $request, Application $application)
    {
       //== VALIDATE DATE NOT IN THE FUTURE
     //====================
      $job = $application->job;
      if(Gate::denies('application_date', $job))
      {
        return back()->withInput($request->all())
        ->with(flash_message("is-warning", "The application submission date can not come before the date the job was post on. Also, a future date can not be accepted for a job application that had already been submitted!"));
      }

        //== UPDATE JOB >> HAS_SUBMITTED BASED ON THE VALUE OF APPLICATION >> HAS_SUBMITTED
       //====================
       $submitted = ($request->get('has_submitted') == 'on')? true : false;
       ($submitted)? $application->job->makeSubmitted() : $application->job->makeUnsubmitted();

        //== UPDATE JOB & INTERVIEWS >> BASED ON THE VALUE OF APPLICATION >> HAS_TURNED_DOWN
       //====================
       if($application->has_turned_down) $rejected = true;
       else
       {
         $rejected = ($request->get('has_turned_down') == 'on')? true : false;
         if($rejected) $this->statusUpdate($application);
       }

       $application->update([
         'submitted_on' => $request->submitted_on,
         'notes' => $request->notes,
         'has_submitted' => $submitted,
         'has_turned_down' => $rejected,
         'resume_id' => $request->resume_id,
         'job_id' => $request->job_id
       ]);

       return redirect('applications')->with(flash_message("is-success", "Record was updated successfully"));

    }

/* //====================
  //== DESTROY
 //==================== */
    public function destroy(Application $application)
    {
        //== VERIFY NOT ASSOCIATED WITH AN UPCOMING INTERVIEW BEFORE DELETING
       //====================
        if($application->isInUse())
        {
          return back()->with(flash_message('is-danger', "Your last action to delete an application submission was rejected because it's associated with a job opportunity that is linked to an interview!"));
        }

        //== IF ASSOCIATED WITH A PAST INTERVIEW RECORD THEN SET APPLICATION TO CANCELED
       //====================
        if($application->pastUse())
        {
          return back()->with(flash_message('is-info', "Your last action to delete an application submission was rejected because it's associated with a job opportunity that is linked to a past interview. Instead your application submission is now set to rejected!"));
        }

        //== UPDATE THE JOB STATUS TO NOT SUBMITTED
      //====================
        $application->job->makeUnsubmitted();
        $application->delete();

        return redirect('/applications')->with(flash_message('is-success', 'The selected application has been deleted successfully.'));
    }

/* //====================
  //== MODAL: VIEW APPLICATION NOTES VIA MODAL
 //==================== */
    public function modal(Application $application)
    {
      return $application->notes;
    }

}
