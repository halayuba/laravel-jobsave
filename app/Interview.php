<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Interview extends Model
{
  protected $guarded = ['id'];

  protected $dates = ['date'];

   //== FIND INTERVIEWS THAT ARE UPCOMING AND HAVE NOT BEEN CANCELED
 //====================
  public function scopeUpcoming($query)
  {
      $query->owns()->where('date', '>=', current_date())->where('is_canceled', false);
  }

  //== APPLICATION >> INDEX: CONFIRM IF A JOB HAS UPCOMING INTERVIEWS
//====================
  public function scopeHasUpcomingInterviews($query)
  {
    $query->where('date', '>=', current_date())->where('is_canceled', false);
  }

  public function scopeCompleted($query)
  {
      $query->owns()->where('date', '<', current_date())->where('is_canceled', false);
  }

  public function scopeFilter($query, $filters)
  {
    if($filters['filter'])
    {
      if($filters['filter'] == 'upcoming'){
        $query->upcoming();
      }
      if($filters['filter'] == 'past'){
        $query->completed();
      }
      if($filters['filter'] == 'canceled'){
        $query->owns()->where('is_canceled', true);
      }
    }
    else $query->mostRecent();
  }

  public function scopeOwns($query)
  {
      $query->where('user_id', auth()->id());
  }

  public function scopeMostRecent($query)
  {
      $query->owns()->orderBy('date', 'desc');
  }

  ///== OFFERS: JOBS WITH SUCCESSFUL INTERVIEWS
  //====================
  public function scopeInterviewsWithPotentialOffers($query)
  {
      $query->where('is_canceled', false)
            ->Where('is_unsuccessful', false)
            ->where('date', '<', current_date())
            ->owns()
            ->orderBy('date', 'desc');
  }

  ///== APPSERVICEPROVIDER >> UPCOMING INTERVIEWS ICON
  //====================
  public function scopeUpcomingInterviewsIcon($query)
  {
    $query->join('jobs', 'interviews.job_id', '=', 'jobs.id')
          ->join('applications', 'jobs.id', '=', 'applications.job_id')
          ->select(\DB::raw('count(*)'))
          ->where('interviews.is_canceled', false)
          ->where('interviews.date', '>=', current_date())
          ->where('jobs.has_closed', false)
          ->where('applications.has_turned_down', false)
          ->where('interviews.user_id', auth()->id());
  }

  public function unsuccessful()
  {
    $this->update(['is_unsuccessful' => true]);
  }

  public function archive()
  {
    $this->update(['is_canceled' => true]);
  }

  public function reactivate()
  {
    $this->update(['is_canceled' => false]);
  }

   //== RELATIONSHIPS
 //====================
   public function interview_type()
   {
       return $this->belongsTo(Interview_type::class);
   }

   public function job()
   {
       return $this->belongsTo(Job::class);
   }

   public function user()
   {
       return $this->belongsTo(User::class);
   }

}
