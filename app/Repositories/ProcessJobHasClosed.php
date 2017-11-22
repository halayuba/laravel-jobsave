<?php

namespace App\Repositories;

use App\Job;

class ProcessJobHasClosed
{
  public function propagateEffect(Job $job)
  {

      //== UPDATE APPLICATION'S STATUS 'has_turned_down' TO TRUE
    //====================
   if($job->application) $job->application->archive();

     //== UPDATE THE STATUS OF ANY PENDING INTERVIEWS 'is_canceled' TO TRUE
    //====================
    if($job->interviews) $job->interviews->each->archive();

  }

  public function undoEffect(Job $job)
  {

    //== UPDATE APPLICATION'S STATUS 'has_turned_down' TO FALSE
    //====================
    if($job->application)  $job->application()->update(['has_turned_down' => false]);

    //== UPDATE THE STATUS OF ANY PENDING INTERVIEWS 'is_canceled' TO FALSE
    //====================
    if($job->interviews->isNotEmpty())
    {
      $interview = $job->interviews->last();
      $interview->reactivate();
    }

  }

}
