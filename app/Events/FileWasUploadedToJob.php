<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

use App\Job;

class FileWasUploadedToJob
{
    use Dispatchable, SerializesModels;

    public $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }

}
