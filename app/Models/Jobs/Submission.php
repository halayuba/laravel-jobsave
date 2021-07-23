<?php

namespace App\Models\Jobs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Carbon\Carbon;

class Submission extends Model
{
  use HasFactory;

  /* == STAT SUMMARY (IN "SubmissionCollection") == */
  /* == GET ALL SUBMISSIONS THAT HAVE "UPCOMING" INTERVIEWS == */
  public function scopeUpcomingInterviews($query)
  {
    /* == FOR THE DEMO: IF NO ONE IS SIGNED IN THEN ASSUME THE ADMIN IS SIGNED IN == */
    $userId = auth()->user() ? auth()->user()->id : 1;

    $query->where('user_id', $userId)
      ->whereHas('interviews', function (Builder $query) {
        $query->where('date', '>=', $this->currentDate())
          ->where('status', '=', 'Upcoming');
      })
      ->with('interviews')
      ->oldest();
  }

  /* == STAT SUMMARY (IN "SubmissionCollection") == */
  /* == GET ALL SUBMISSIONS THAT:
          1. WHERE THE SUBMISSION IS WITHIN A MONTH
          2. WHERE SUBMISSION STATUS IS NOT "UNSUCCESSFUL" OR "WITHDRAWN" (IE. "NO FEEDBACK")
          3. DO NOT HAVE INTERVIEWS
          4. OR WITH INTERVIEWS BUT NOT "UPCOMING"
          USED FOR USE IN "AddSubmissionInterviewModal" ==
    */
  public function scopeFilteredSubmissions($query)
  {
    /* == FOR THE DEMO: IF NO ONE IS SIGNED IN THEN ASSUME THE ADMIN IS SIGNED IN == */
    $userId = auth()->user() ? auth()->user()->id : 1;

    $query->where('created_at', '>=', $this->monthAgo())
      ->where('status', 'No Feedback')
      ->where('user_id', $userId)
      ->where(function ($query) {
        $query->doesntHave('interviews');
        $query->OrWhereHas('interviews', function (Builder $query) {
          $query->where('status', '!=', 'Upcoming');
        });
      });
  }

  /* == STAT SUMMARY (IN "SubmissionCollection") == */
  /* == GET ALL SUBMISSIONS THAT LED TO HAVING AN INTERVIEW == */
  public function scopeSubmissionsHaveInterviews($query)
  {
    /* == FOR THE DEMO: IF NO ONE IS SIGNED IN THEN ASSUME THE ADMIN IS SIGNED IN == */
    $userId = auth()->user() ? auth()->user()->id : 1;

    $query->where('user_id', $userId)
      ->has('interviews');
  }

  /* == STAT SUMMARY (IN "SubmissionCollection") == */
  /* == COUNT SUBMISSIONS SINCE LAST WEEK == */
  public function scopeSubmissionsSinceLastWeek($query)
  {
    /* == FOR THE DEMO: IF NO ONE IS SIGNED IN THEN ASSUME THE ADMIN IS SIGNED IN == */
    $userId = auth()->user() ? auth()->user()->id : 1;

    $query->where('user_id', $userId)
      ->where('created_at', '>=', $this->lastWeek());
  }

  /* == GET ALL SUBMISSION WITH PAST OR NO INTERVIEWS == */
  public function scopeSubmissionsWithPastOrNoInterviews($query)
  {
    /* == FOR THE DEMO: IF NO ONE IS SIGNED IN THEN ASSUME THE ADMIN IS SIGNED IN == */
    // $userId = auth()->user() ? auth()->user()->id : 1;

    // $query->where('user_id', $userId)
    $query->doesntHave('interviews')
      ->OrWhereHas('interviews', function (Builder $query) {
        $query->where('date', '<=', $this->currentDate())
          ->orWhere('status', '!=', 'Upcoming');
      })
      ->with('interviews')
      ->latest();
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

  public function lastWeek()
  {
    return Carbon::today()->setTimezone('America/Chicago')->subWeek()->toDateString();
  }

  public function monthAgo()
  {
    return Carbon::today()->setTimezone('America/Chicago')->subWeek(4)->toDateString();
  }

  public function currentDate()
  {
    return Carbon::today()->setTimezone('America/Chicago')->toDateString();
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
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function interviews()
  {
    return $this->hasMany(Interview::class);
  }
}
