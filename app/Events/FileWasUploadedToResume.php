<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

use App\Resume;

class FileWasUploadedToResume
{
    use Dispatchable, SerializesModels;

    public $resume;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Resume $resume)
    {
      $this->resume = $resume;
    }

}
