<?php

namespace App\Listeners;

use App\Events\FileWasUploadedToResume;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Repositories\ProcessFileUpload;
use App\Resume;
use App\Upload;

class ResumeFileUploadProcessing
{
    protected $file;

    public function __construct(ProcessFileUpload $file)
    {
        $this->file = $file;
    }

    /**
     * Handle the event.
     *
     * @param  FileWasUploadedToResume  $event
     * @return void
     */
    public function handle(FileWasUploadedToResume $event)
    {
          //== PROCESS FILE UPLOAD TO THE "UPLOAD" TABLE USING REPOSITORY
       //====================
        $upload = $this->file->updateUploadTable();

        //== SAVE UPLOADED FILE TO THE "UPLOAD" TABLE
       //====================
        $resume = Resume::find($event->resume->id);

        $resume->uploads()->save($upload);
    }
}
