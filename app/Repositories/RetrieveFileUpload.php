<?php

namespace App\Repositories;

use App\Job;
use Storage;

class RetrieveFileUpload
{

  public function imageDetails(Job $job)
  {
    //== GET FILE UPLOAD DETAILS
   //====================
    $image = [];

       //== ACCESS THE TYPE OF THE FILE UPLOAD
     //====================
      $rec = $job->uploads()->first();
      // $isImage = is_image($rec->extension);
      if($rec->is_image)
      {
        $image['is_image'] = true;
        $image['is_download'] = false;
        $image['name'] = Storage::disk('local')->url($job->file);
        $image['width'] = $rec->width + 10;
        $image['height'] = $rec->height + 10;
      }
      else
      {
        $image['is_image'] = false;
        $image['is_download'] = true;
      }

     return $image;
  }
}
