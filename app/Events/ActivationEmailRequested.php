<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use App\User;

class ActivationEmailRequested
{
    use Dispatchable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
      $this->user = $user;
    }

}
