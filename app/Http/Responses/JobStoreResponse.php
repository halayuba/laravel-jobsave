<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

use Gate;
use App\Job;
use App\Events\FileWasUploadedToJob;
use Illuminate\Support\Facades\Storage;

class JobStoreResponse implements Responsable
{
  protected $path, $job;

  public function __construct(Job $job)
  {
      $this->path = 'public/jobs';
      $this->job = $job;
  }

  public function toResponse($request)
  {
      ///== CONFIRM NOT A DUPLICATE JOB
      //====================
      if($this->job->duplicateRecord())
      {
        return back()->withInput($request->all())
         ->with(flash_message('is-warning', 'This seem to be a duplicate record or at least has a job title that already exist for the same employer!'));
      }

        //== DATE VALIDATION: "LAST_UPDATE" FIELD
      //====================
       if(Gate::denies('acceptable_date', $request->date_posted))
       {
         return back()->withInput($request->all())
          ->with(flash_message('is-warning', 'Can not accept a future date or a date older than a month ago (must be within the last month not exceeding today\'s date!'));
       }

       //== HANDLE CHECKBOX & OTHER ATTRIBUTES: REMEMBER TO KEEP THIS SECTION HERE TO COVER THE SCENARIO WHEN THERE IS NO FILE UPLOAD
      //====================
      $bookmarked = ($request->get('checkbox') == 'on')? true : false;

      $request = request()->except(['file', 'checkbox']);
      $request['identifier'] = uniqid();
      $request['is_bookmarked'] = $bookmarked;
      $request['job_role_id'] = 1; //temporary

        //== CHECK IF A FILE UPLOAD IS INCLUDED WITH THE FORM
       //====================
      if(request()->hasFile('file') && request()->file('file')->isValid())
      {
        $file = request()->file('file');
        $filename = $file->getClientOriginalName();
        $filePathAndName = $this->path.'/'.$filename;

          //== CONFIRM FILE DOES NOT ALREADY EXIST IN THE DB
        //====================
        if($this->job->fileUploadExists($filePathAndName))
        {
          return back()->withInput($request)->with(flash_message('is-warning', 'This could be a duplicate record!! The job attachment you\'re trying to upload had previously been saved in the database! You won\'t be able to save a file with the same upload name.'));
        }

          //== ASSIGN ABOVE VALUE TO ATTRIBUTE
         //====================
         $request['file'] = $filePathAndName;
      }

      //== SAVE RECORD TO DB
     //====================
     if(auth()->user()->jobs()->create($request))
     {
       if(request()->hasFile('file'))
       {
          //== SAVE TO FILE SYSTEM
         //====================
         $file->storeAs($this->path, $filename);

           //== RETREIVE THE LAST RECORD: SINCE THIS EVENT IS CALLED DIRECTLY AFTER THE CREATION OF NEW JOB
         //====================
         $job = Job::all()->last();

          //== PROCESS FILE UPLOAD TO "UPLOAD" TABLE
         //====================
         event(new FileWasUploadedToJob($job));
       }
     }

     return redirect('jobs')->with(flash_message('is-success', 'A new job detail has been created successfully!'));

  }
}
