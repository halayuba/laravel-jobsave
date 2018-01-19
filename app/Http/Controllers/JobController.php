<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use Illuminate\Support\Facades\Storage;
// use App\Events\FileWasUploadedToJob;
use App\Repositories\{RetrieveFileUpload, ProcessJobHasClosed};
use App\{Job, Employer, Upload};
use App\Http\Responses\{JobStoreResponse, JobUpdateResponse};

class JobController extends Controller
{

/* //====================
  //== INDEX
 //==================== */
    public function index()
    {
      if(request(['filter']))
      {
        $jobs = Job::jobFilters(request(['filter']))
        ->with(['employer', 'venue', 'employment_type'])
        ->paginate(8);
      }
      else
      {
        $jobs = Job::current()->with(['employer', 'venue', 'employment_type'])->paginate(8);
      }
      return view("jobs.index", compact('jobs'));

    }

/* //====================
  //== CREATE
 //==================== */
    public function create()
    {
      return view("jobs.create");
    }

/* //====================
  //== CREATE BUT SPECIFIC TO EMPLOYER
 //==================== */
    public function createSpecific($id)
    {
      return view("jobs.createSpecific", compact('id'));
    }

/* //====================
  //== STORE
 //==================== */
    public function store(JobRequest $request, Job $job)
    {
      return new JobStoreResponse($job);
    }

/* //====================
  //== SHOW
 //==================== */
    public function show(Job $job, RetrieveFileUpload $file)
    {

       //== DETERMINE IF FILE UPLOAD EXISTS AND RETREIVE NAME
     //====================
       if($job->file)
       {
          //== RETREIVE IMAGE DETAILS USING REPOSITORY
        //====================
         $image = $file->imageDetails($job);
         $filename = str_after($job->file, 'public/jobs/');
       }
       else
       {
         $filename = "No file uploaded";
         $image = NULL;
       }

      return view("jobs.show", compact('job', 'filename', 'image'));
    }

/* //====================
  //== EDIT
 //==================== */
    public function edit(Job $job)
    {
      return view("jobs.edit", compact('job'));
    }

/*   //====================
    //== STATUS UPDATE:
   //== IF THE JOB STATUS CHANGED TO 'has_closed' THEN UPDATE APPLICATION'S STATUS
  //== 'has_turned_down' TO TRUE THEN UPDATE THE STATUS OF ANY PENDING INTERVIEWS 'is_canceled' TO TRUE
 //==================== */
    public function statusUpdate(Job $job, ProcessJobHasClosed $jobClose)
    {
        //ARCHIVE JOB
        $job->archive();

        //PERFORM UPDATE ON APPLICATIONS AND INTERVIEWS USING REPOSITORY
        $jobClose->propagateEffect($job);

        return back()->with(flash_message('is-success', 'The status of the selected application has been updated to Rejected.'));
    }

/* //====================
  //== UPDATE
 //==================== */
    public function update(JobRequest $request, Job $job, ProcessJobHasClosed $jobClose)
    {
      return new JobUpdateResponse($job, $jobClose);
    }

/* //====================
  //== DESTORY
 //==================== */
    public function destroy(Job $job)
    {
        //== VERIFY NOT IN USE ON ANY APPLICATIONS BEFORE DELETING
     //====================
      if($job->inUse())
      {
        return back()->with(flash_message('is-danger', "Your last action to delete job [{$job->title}] was rejected as it's currently associated with a submitted application!"));
      }
      //== DELETE FROM DB
    //====================
      if($job->delete())
      {
        //== CHECK IF THERE IS A FILE UPLOAD ASSOCIATED WITH THE DELETED JOB
      //====================
       if($job->file)
       {
         //== DELETE FROM FILE STORAGE
       //====================
         Storage::delete($job->file);

         //== DELETE FROM 'UPLOAD' TABLE
       //====================
         $job->uploads->first()->delete();
       }
        return redirect('/jobs')->with(flash_message('is-success', 'The selected job has been deleted successfully.'));
      }
    }

/* //====================
  //== DOWNLOAD
 //==================== */
    public function download(Job $job)
    {
      if($job->hasNoUpload())
      {
        return back()->with(flash_message('is-warning', "There was no description uploaded with this stored record for job ({$job->identifier})"));
      }
      $file = storage_path('app/' . $job->file);
      return response()->download($file);
    }

/* //====================
  //== INDEX BY EMPLOYER
 //==================== */
    public function indexByEmployer(Employer $employer)
    {
      $jobs = $employer->jobs;
      $jobs = $jobs->load('venue', 'employment_type', 'employer');
      return view("jobs.index", compact('jobs'));
    }
}
