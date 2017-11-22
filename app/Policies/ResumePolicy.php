<?php

namespace App\Policies;

use App\User;
use App\Resume;
use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResumePolicy
{
    use HandlesAuthorization;

    protected $now;

    public function __construct()
    {
      $this->now = Carbon::today('America/Chicago');
    }

    public function acceptable_date($val)
    {
        return $this->now >= $val;
    }

    public function acceptable_format($file)
     {
       $fileExt = $file->guessClientExtension();
       return ! is_image($fileExt);
     }


}
