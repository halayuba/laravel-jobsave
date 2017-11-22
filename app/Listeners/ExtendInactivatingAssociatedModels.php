<?php

namespace App\Listeners;

use App\Events\ActionDeleteEmployerInUse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExtendInactivatingAssociatedModels
{

    /**
     * Handle the event.
     *
     * @param  ActionDeleteEmployerInUse  $event
     * @return void
     */
    public function handle(ActionDeleteEmployerInUse $event)
    {
      $event->employer->archive();

      foreach ($event->employer->jobs as $job) {
        $job->archive();
        optional($job->application)->archive();
        optional($job->offer)->archive();
        $job->interviews->each->archive();
      }
    }
}
