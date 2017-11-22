<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Resume;

class ValidateFileUpload
{

  protected $request, $resume;

  public function __construct(Request $request, Resume $resume)
  {
      $this->path = 'public/resumes';
      $this->request = $request;
      $this->resume = $resume;
  }

  public function uploadValidation()
  {
    $file = $this->request->file('file');
    $filename = $file->getClientOriginalName();
    $filePathAndName = $this->path.'/'.$filename;

      //== CONFIRM FILE DOES NOT ALREADY EXIST IN THE DB
    //====================
    if($this->resume->fileUploadExists($filePathAndName))
    {
      return back()->withInput($this->request->all())->with(flash_message('is-warning', 'A resume upload with the same name had previously been saved in the database! You will not be able to create a new record with the same resume'));
    }

      //== CONFIRM FILE UPLOAD DOES NOT HAVE A FORMAT OF AN IMAGE
    //====================
    if(! policy($this->resume)->acceptable_format($file))
    {
      return redirect('resumes/create')->withInput($this->request->all())
      ->with(flash_message('is-warning', 'Please upload your resume in PDF format or a non-image format!'));
    }

    return $filename;

  }
}
