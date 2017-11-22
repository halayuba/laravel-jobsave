<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

use App\Resume;
use App\Events\FileWasUploadedToResume;
use Illuminate\Support\Facades\Storage;

class ResumeUpdateResponse implements Responsable
{
  protected $path, $resume, $upload;

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
         'title' => 'required|min:3|unique:resumes,title,' . $this->resume->id,
         'file' => 'max:1999'
     ], ['title.unique' => 'Updating the title of the resume has failed as this title is used for another resume!']);

      //== DATE VALIDATION: "LAST_UPDATE" FIELD
    //====================
     if(! policy($this->resume)->acceptable_date($request->last_update))
     {
       return back()->withInput($request->all())->with(flash_message('is-warning', 'Can not accept a future date for when your resume was updated last!'));
     }

        //== CHECK IF THERE WAS A FILE UPLOAD
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
         return back()->withInput($request->all())->with(flash_message('is-warning', 'A resume upload with the same name had previously been saved in the database! You will not be able to create a new record with the same resume'));
       }

         //== CONFIRM FILE UPLOAD DOES NOT HAVE A FORMAT OF AN IMAGE
       //====================
       if(! policy($this->resume)->acceptable_format($file))
       {
         return back()->withInput($request->all())
         ->with(flash_message('is-warning', 'Please upload your resume in PDF format or a non-image format!'));
       }

       //== CHECK IF THERE HAS BEEN A FILE UPLOAD ASSOCIATED WITH THIS RESUME AND BEGIN BY PERFORMING REPLACEMENT
     //====================
      if($this->resume->file) $this->deleteOldUpload($this->resume);

         //== UPDATE RESUME RECORD IN DB
        //====================
       $this->resume->update([
         'title' => $request->title,
         'folder' => $request->folder,
         'last_update' => $request->last_update,
         'file' => $filePathAndName
       ]);

         //== SAVE TO FILE STORAGE
        //====================
       $file->storeAs($this->path, $filename);

        //== PROCESS FILE UPLOAD TO THE "UPLOAD" TABLE USING EVENT/LISTERNER
       //====================
       event(new FileWasUploadedToResume($this->resume));

     }
     //NO FILE UPLOAD
     else $this->resume->update($request->all());

     return redirect('resumes')->with(flash_message('is-success', 'Your update has taken effect.'));

  }

   //== FILE UPLOAD REPLACEMENT
 //====================
  public function deleteOldUpload($resume)
  {
      //== DELETE FROM FILE STORAGE
      //====================
      Storage::delete($resume->file);

      //== DELETE FROM 'UPLOAD' TABLE
      //====================
      if($upload = $resume->uploads->first()) $upload->delete();
  }

}
