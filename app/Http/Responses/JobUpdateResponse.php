<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

use Gate;
use App\Job;
use App\Events\FileWasUploadedToJob;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ProcessJobHasClosed;

class JobUpdateResponse implements Responsable
{
  protected $path, $job, $jobClose;

  public function __construct(Job $job, ProcessJobHasClosed $jobClose)
  {
      $this->path = 'public/jobs';
      $this->job = $job;
      $this->jobClose = $jobClose;
  }

  public function toResponse($request)
  {
    ///== CONFIRM NOT A DUPLICATE JOB
    //====================
    if($this->job->duplicateRecordUpdating($this->job->id))
    {
      return back()->withInput($request->all())
       ->with(flash_message('is-warning', 'This seem to be a duplicate record or at least has a job title that already exist for the same employer!'));
    }

      //== DATE VALIDATION: "LAST_UPDATE" FIELD
    //====================
     if(Gate::denies('acceptable_date', $request->date_posted))
     {
       return back()->withInput($request->all())
       ->with(flash_message('is-warning', 'The date is out of the acceptable range: the date can not be older than 30 days and it can not be in the future.'));
     }

     //== HANDLING CHECKBOX
    //====================
    $bookmarked = ($request->get('checkbox') == 'on')? true : false;
    $hasClosed = ($request->get('has_closed') == 'on')? true : false;

    //== USING REPOSITORY: PROCESS SELECTING THE CHECK BOX FOR HAS_CLOSED
  //====================
    //== IF $hasClosed IS TRUE THEN UPDATE APPLICATION & INTERVIEWS
    if($hasClosed) $this->jobClose->propagateEffect($this->job);
    //== IF $hasClosed IS FALSE REVERSE ACTIONS APPLIED TO APPLICATION AND INTERVIEWS
    elseif($this->job->has_closed != $hasClosed) $this->jobClose->undoEffect($this->job);

    //== HANDLING OTHER ATTRIBUTES
   //====================
    $request = request()->except(['file', 'checkbox']);
    $request['is_bookmarked'] = $bookmarked;
    $request['has_closed'] = $hasClosed;
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
         return back()->withInput($request)->with(flash_message('is-warning', 'The job attachment you\'re trying to upload had previously been saved in the database! You won\'t be able to save a file with the same upload name.'));
       }

       //== ASSIGN ABOVE VALUE TO ATTRIBUTE
      //====================
      $request['file'] = $filePathAndName;

       //== CHECK IF THERE IS A FILE UPLOAD ASSOCIATED WITH THIS JOB AND BEGIN BY PERFORMING REPLACEMENT
     //====================
      if($this->job->file) $this->deleteOldUpload($this->job);

     }

      //== UPDATE RECORD
    //====================
     if($this->job->update($request))
     {
       if(request()->hasFile('file'))
       {
           //== SAVE TO FILE SYSTEM
          //====================
         $file->storeAs($this->path, $filename);

          //== PROCESS FILE UPLOAD TO "UPLOAD" TABLE
         //====================
         event(new FileWasUploadedToJob($this->job));
       }

     }

     return redirect('jobs')->with(flash_message('is-success', 'Your update has taken effect.'));

  }

    //== FILE UPLOAD REPLACEMENT
  //====================
  public function deleteOldUpload($job)
  {
    //== DELETE FROM FILE STORAGE
  //====================
    Storage::delete($job->file);

    //== DELETE FROM 'UPLOAD' TABLE
  //====================
    if($upload = $job->uploads->first()) $upload->delete();

  }

}
