<?php

namespace App\Listeners;

use App\Events\FileWasUploadedToJob;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Repositories\ProcessFileUpload;
use App\{Job, Upload};

class JobFileUploadProcessing
{
    protected $file;

    public function __construct(ProcessFileUpload $file)
    {
        $this->file = $file;
    }

    /**
     * Handle the event.
     *
     * @param  FileWasUploadedToJob  $event
     * @return void
     */
    public function handle(FileWasUploadedToJob $event)
    {
        //== PROCESS FILE UPLOAD TO THE "UPLOAD" TABLE USING REPOSITORY
      //====================
       $upload = $this->file->updateUploadTable();

       //== SAVE UPLOADED FILE TO THE "UPLOAD" TABLE
      //====================
       $job = Job::find($event->job->id);

       $job->uploads()->save($upload);
    }
}
