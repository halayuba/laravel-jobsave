<?php

namespace App\Models\Jobs;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Interview extends Model
{
  use HasFactory;

  protected $casts = ['date' => 'date:Y-m-d', 'time' => 'datetime:h:i A'];

  public static function boot()
  {
    parent::boot();
    static::creating(function ($interview) {
      if ($interview->date->lt(Carbon::today()->toDateString())) $interview->status = "Completed";
      else $interview->status = "Upcoming";
    });
  }

  public function getInterviewDateTimeAttribute()
  {
    return $this->date->format('m/d/y') . ' @ ' . $this->time->format('h:i A');
  }

  public function completed()
  {
    return $this->update([
      'status' => 'Completed'
    ]);
  }

  /*
    CONCEPTUAL WORKFLOW (INITIAL THOUGHTS AND NEED TO BE VALIDATED)
    - recording a new submission will have initial status:
        * submission: "Pending Feedback"

    - receiving a rejection to a submission will update status:
        * submission: "Unsuccessful"

    - recording a new interview will have status:
        * submission: "Interview"
        * interview: "Upcoming"

    - cancelling an interview will have status:
        * submission: "Unsuccessful"
        * interview: "Canceled"

    - rescheduling an interview will have status:
        * submission: "Interview"
        * interview: "Rescheduled"

    - completing an interview will have status:
        * submission: "Interview"
        * interview: "Completed"

    - after 30 days of a submission with no interviews, update status
        * submission: from "Pending Feedback" to "Unsuccessful"

    - 30 days after an interview with no feedback, update status
        * submission: from "Pending Feedback" to "Unsuccessful"
        * interview: "Completed"
    */

  public function scopeCompletedInterviews($query)
  {
    $user = auth()->user() ?: User::find(1);

    $query->where([
      ['status', "Completed"],
      ['user', $user->id]
    ]);
  }

  /* //====================
      //== RELATIONSHIPS
     //==================== */
  public function submission()
  {
    return $this->belongsTo(Submission::class);
  }
}
