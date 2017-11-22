<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interview;
use App\Job;
use Gate;

class InterviewController extends Controller
{
/* //====================
  //== INDEX
 //==================== */
    public function index()
    {
      // $jobs = $job->hasInterviews()->get();
      // dd($jobs->interviews->date);
      // return view("interviews.index", compact('jobs'));
      // $interviews = Interview::upcoming()->get();

      // $interviews = Interview::oldest()

      // $interviews = Interview::mostRecent()->with('job')
      //   ->filter(request(['filter']))
      //   ->paginate(8);
      // return view("interviews.index", compact('interviews'));
      // return request(['filter'])? 't' : 'f';
      if(request(['filter']))
      {
        $interviews = Interview::filter(request(['filter']))->with('job.employer', 'interview_type')->paginate(8);
      }
      else
      {
        $interviews = Interview::mostRecent()->with('job.employer', 'interview_type')->paginate(8);
      }
      return view("interviews.index", compact('interviews'));
    }

/* //====================
  //== JOBLIST: LIST OF JOBS WITH SUBMITTED APPLICATIONS (TO SELECT FROM AND PROCEED TO CREATE AN INTERVIEW RECORD)
 //==================== */
    public function jobList(Job $job)
    {
      $jobs = $job->submittedJobs()->get();
      return view("interviews.jobList", compact('jobs'));
    }

/* //====================
  //== CREATE
 //==================== */
    public function create(Job $job)
    {
      return view("interviews.create", compact('job'));
    }

/* //====================
  //== STORE
 //==================== */
    public function store(Request $request, Job $job)
    {
      request()->validate([
        'date' => 'required',
        'time' => 'required'
      ]);

      if(Gate::denies('interview_date', $job))
      {
        return back()->withInput($request->all())
          ->with(flash_message("is-warning", "You are only allowed to track interview appointments that are 30 days past or 30 days in the future. And the interview date must come after the application submission date."));
      }

        //== HANDLING CHECKBOX
       //====================
        $interview_canceled = ($request->get('is_canceled') == 'on')? true : false;
        $request = request()->except(['is_canceled']);
        $request['is_canceled'] = $interview_canceled;
        $request['user_id'] = \Auth::id();

        if($job->interviews()->create($request))
        {
          if($interview_canceled)
          {
            return redirect('interviews')->with(flash_message('is-success', 'You have created an interview record and set the status to Canceled!'));
          }
          return redirect('interviews')->with(flash_message('is-success', 'You have successfully created a new record for an upcoming interview!'));
        }
    }

/* //====================
  //== SHOW
 //==================== */
    public function show(Interview $interview, Job $job)
    {
      return view("interviews.show", compact('interview', 'job'));
    }

/* //====================
  //== EDIT
 //==================== */
    public function edit(Interview $interview)
    {
      return view("interviews.edit", compact('interview'));
    }

/* //====================
  //== STATUS UPDATE: UPDATE INTERVIEW STATUS TO CANCELED
 //==================== */
    public function statusUpdateCanceled(Interview $interview)
    {
      if($interview->archive())
      {
        return back()->with(flash_message('is-success', 'The status of the selected interview has been updated to Canceled.'));
      }
      return back()->with(flash_message('is-danger', 'Update failed. Please try again later!'));
    }

/* //====================
  //== STATUS UPDATE: UPDATE INTERVIEW STATUS TO UNSUCCESSFUL
 //==================== */
    public function statusUpdateUnsuccessful(Interview $interview)
    {
      // if($interview->unsuccessful())
      // {
        $interview->unsuccessful();
        // $interview->job->archive();
        $job = $interview->job;
        // dd($job);
        $job->archive();
        $job->application->archive();

        // return back()->with(flash_message('is-success', 'The status of the selected interview has been updated to Unsuccessful.'));
      // }
      return back()->with(flash_message('is-danger', 'Update failed. Please try again later!'));
    }

/* //====================
  //== UPDATE FORM
 //==================== */
    public function update(Request $request, Interview $interview)
    {
      if($interview->is_canceled)
      {
        $request = request()->only(['interviewer', 'notes']);
      }
      else
      {
        request()->validate([
          'date' => 'required',
          'time' => 'required'
        ]);

        $job = $interview->job;

        if(Gate::denies('interview_date', $job))
        {
          return back()->withInput($request->all())->with(flash_message("is-warning", "You are only allowed to update interview appointments that fall within +/- 30 days!. And the interview date must come after the application submission date.
          "));
        }

        ///== HANDLING "is_canceled" CHECKBOX
        //====================
        $interview_canceled = ($request->get('is_canceled') == 'on')? true : false;
        $request = request()->except(['is_canceled']);
        $request['is_canceled'] = $interview_canceled;
      }

        $interview->update($request);
        return redirect('interviews')->with(flash_message('is-success', 'You have successfully updated the details of your interview!'));
    }

/* //====================
  //== DESTROY
 //==================== */
    public function destroy(Interview $interview)
    {
        $interview->delete();
        return redirect('/interviews')->with(flash_message('is-success', 'The selected interview appointment has been deleted successfully.'));
    }
}
