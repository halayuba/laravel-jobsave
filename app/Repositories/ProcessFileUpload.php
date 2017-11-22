<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Upload;

class ProcessFileUpload
{

  protected $request;

  public function __construct(Request $request)
  {
      $this->request = $request;
  }

  public function updateUploadTable()
  {
    //== GET FILE UPLOAD DETAILS
   //====================
    $file = $this->request->file('file');
    $filename = $file->getClientOriginalName();
    $fileSize = $file->getClientSize();
    $fileExt = $file->guessClientExtension();
    if(is_image($fileExt))
    {
       $image_size = getimagesize($file);
       $width = $image_size[0];
       $height = $image_size[1];
       $is_image = 1;
    }
    else
    {
       $width = NULL;
       $height = NULL;
       $is_image = 0;
    }

    //== PROCESS SAVE TO "UPLOAD" TABLE
   //====================
    $upload = new Upload([
      'file_name' => $filename,
      'is_image' => $is_image,
      'extension' => $fileExt,
      'size' => $fileSize,
      'width' => $width,
      'height' => $height
    ]);

     return $upload;
  }
}
