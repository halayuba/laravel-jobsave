<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Events\FileWasUploadedToResume;
use App\Resume;
use App\Upload;
use App\Http\Responses\ResumeStoreResponse;
use App\Http\Responses\ResumeUpdateResponse;
use App\Repositories\ValidateFileUpload;

class ResumeController extends Controller
{
    public $path;

    public function __construct()
    {
        $this->path = 'public/resumes';
    }

/* //====================
  //== INDEX
 //==================== */
    public function index()
    {
      $resumes = Resume::owns()->latest()->get();
      return view("resumes.index", compact('resumes'));
    }

/* //====================
  //== CREATE
 //==================== */
    public function create()
    {
      return view("resumes.create");
    }

/* //====================
  //== STORE
 //==================== */
    public function store(Request $request, Resume $resume)
    {
      return new ResumeStoreResponse($resume);
    }

/* //====================
  //== EDIT
 //==================== */
    public function edit(Resume $resume)
    {
      return view("resumes.edit", compact('resume'));
    }

/* //====================
  //== UPDATE
 //==================== */
    public function update(Request $request, Resume $resume, ValidateFileUpload $upload)
    {
      return new ResumeUpdateResponse($resume, $upload);
    }

/* //====================
  //== DESTROY
 //==================== */
    public function destroy(Resume $resume)
    {
       //== VERIFY NOT IN USE ON ANY APPLICATIONS BEFORE DELETING
     //====================
      if($resume->inUse())
      {
        return back()->with(flash_message('is-danger', "Your last action to delete resume {$resume->title} was rejected as it's currently associated with a submitted application!"));
      }
       //== DELETE FROM DB
     //====================
      if($resume->delete())
      {
         //== CHECK IF THERE IS A FILE UPLOAD ASSOCIATED WITH THE DELETED RESUME
       //====================
        if($resume->file)
        {
          //== DELETE FROM FILE STORAGE
        //====================
          Storage::delete($resume->file);

          //== DELETE FROM 'UPLOAD' TABLE
        //====================
          if($upload = $resume->uploads->first())
          {
            $upload->delete();
          }
        }

        return redirect('/resumes')->with(flash_message('is-success', 'The selected resume has been deleted successfully.'));
      }
    }

/* //====================
  //== DOWNLOAD
 //==================== */
    public function download(Resume $resume)
    {
      if($resume->hasNoUpload())
      {
        return back()->with(flash_message('is-warning', "There was no resume uploaded with this stored record titled ({$resume->title})"));
      }
      $file = storage_path('app/' . $resume->file);
      return response()->download($file);
    }

}
