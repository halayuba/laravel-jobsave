<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

use App\Resume;
use App\Events\FileWasUploadedToResume;
use Illuminate\Support\Facades\Storage;

class ResumeStoreResponse implements Responsable
{
  protected $path, $resume;

  public function __construct(Resume $resume)
  {
      $this->path = 'public/resumes';
      $this->resume = $resume;
  }

  public function toResponse($request)
  {
    //== INPUT VALIDATION
  //====================
    request()->validate([
      'title' => 'required|min:3|unique:resumes,title',
      'file' => 'max:1999'
    ], ['title.unique' => 'This resume seems to have been previously created based on the title you entered in the form for the resume!']);

      //== DATE VALIDATION: "LAST_UPDATE" FIELD
    //====================
     if(! policy($this->resume)->acceptable_date($request->last_update))
     {
       return back()->withInput($request->all())
        ->with(flash_message('is-warning', 'Can not accept a future date for when your resume was updated last!'));
     }

    //== CHECK IF A FILE UPLOAD IS INCLUDED WITH THE FORM
   //====================
    if($request->hasFile('file') && $request->file('file')->isValid())
    {
      $file = $request->file('file');
      $filename = $file->getClientOriginalName();
      $filePathAndName = $this->path.'/'.$filename;

      //== CONFIRM FILE DOES NOT ALREADY EXIST IN THE DB
     //====================
     if($this->resume->fileUploadExists($filePathAndName))
     {
       return back()->withInput($request->all())->with(flash_message('is-warning', 'A resume with the same name had previously been saved in the database! You will not be able to create a new record with the same resume'));
     }

     //== CONFIRM FILE UPLOAD HAS A FORMAT OF PDF OR DOC
     //====================
     if(! policy($this->resume)->acceptable_format($file))
     {
       return back()->withInput($request->all())
       ->with(flash_message('is-warning', 'Please upload your resume in PDF format or a non-image format!'));
     }

       //== SAVE TO DB
      //====================
     $this->resume = new Resume([
       'title' => $request->title,
       'folder' => $request->folder,
       'last_update' => $request->last_update,
       'file' => $filePathAndName,
     ]);

      //== ASSOCIATE USER
    //====================
     $this->resume->user()->associate($request->user());

     if($this->resume->save())
     {
         //== SAVE TO FILE SYSTEM
        //====================
       $file->storeAs($this->path, $filename);

       //== PROCESS FILE UPLOAD TO "UPLOAD" TABLE
       //====================
       event(new FileWasUploadedToResume($this->resume));
     }

    }
     //== NO FILE UPLOAD
   //====================
    else $request->user()->resumes()->create($request->all());

    return redirect('resumes')->with(flash_message('is-success', 'A new Resume has been created successfully!'));

  }
}
