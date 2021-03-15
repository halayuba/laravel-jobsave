<?php

namespace App\Models\Jobs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Submission extends Model
{
    use HasFactory;

    /* == GET ALL SUBMISSIONS THAT HAVE "UPCOMING" INTERVIEWS == */
    public function scopeUpcomingInterviews($query)
    {
        $query->whereHas('interviews', function(Builder $query){
          $query->where('date', '>=', Carbon::now()->toDateString())
                ->where('status', '=', 'Upcoming')
                ->with('interviews')
                ->oldest();
        });
    }

    /* == GET ALL SUBMISSION WITH PAST OR NO INTERVIEWS == */
    public function scopeSubmissionsWithPastOrNoInterviews($query)
    {
        $query->doesntHave('interviews')
              ->OrWhereHas('interviews', function(Builder $query){
                  $query->where('date', '<', Carbon::now()->toDateString());
                })
              ->with('interviews')
              ->latest();
    }

    /* == GET ALL SUBMISSIONS THAT DO NOT HAVE INTERVIEWS AND ARE NOT "UNSUCCESSFUL" OR HAVE "OFFERS" USED FOR "AddSubmissionInterviewModal" == */
    public function scopeFilteredSubmissions($query)
    {
        $query->doesntHave('interviews')
              ->where('status', 'No Feedback');
    }

    /* == GET ALL SUBMISSIONS THAT HAD "COMPLETED" INTERVIEWS == */
    // public function scopeCompletedInterviews($query)
    // {
    //     $query->whereHas('interviews', function(Builder $query){
    //       $query->where('status', 'Completed')
    //             ->latest();
    //     });
    // }

    /* == GET ALL SUBMISSIONS THAT HAD INTERVIEWS BUT NOT "UPCOMING" == */
    // public function scopeSetUpInterviews($query)
    // {
    //     $query->whereHas('interviews', function(Builder $query){
    //       $query->where('date', '<', Carbon::now()->toDateString());
    //             ->where('status', '!=', 'Upcoming')
    //             ->latest();
    //     });
    // }

    /* == GET ALL SUBMISSIONS THAT DO NOT HAVE INTERVIEWS AND ARE NOT "UNSUCCESSFUL" OR HAVE "OFFERS" == */
    // public function scopeUnsuccessfulSubmissions($query)
    // {
    //     $query->doesntHave('interviews');
    //           ->where('status', 'No Feedback');
    // }

    /* == GET ALL SUBMISSIONS THAT ENDED UP WITH INTERVIEWS == */
    public function scopeSubmissionsHaveInterviews($query)
    {
        $query->has('interviews');
    }

    public function lastWeek()
    {
      return Carbon::today()->setTimezone('America/Chicago')->subWeek()->toDateString();
    }

    /* == COUNT SUBMISSIONS SINCE LAST WEEK == */
    public function scopeSubmissionsSinceLastWeek($query)
    {
        $query->where('created_at', '>=', $this->lastWeek());
    }

    public function scopeFindDuplicateRecord($query)
    {
        $query->where([
          ['company', request()->company],
          ['location', request()->location],
          ['position', request()->position]
        ]);
    }

    public function NotUniqueForUpdate()
    {
      return Submission::findDuplicateRecord()->exists() && Submission::findDuplicateRecord()->first()->id !== $this->id;
    }

    /* //====================
      //== RELATIONSHIPS
     //==================== */
     public function interviews()
     {
         return $this->hasMany(Interview::class);
     }
}
