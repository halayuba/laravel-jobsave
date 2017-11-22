<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Application extends Model
{
    protected $guarded = ['job_id', 'resume_id', 'user_id'];

    protected $dates = ['submitted_on'];

    public function scopeSubmitted($query)
    {
        $query->owns()->where('has_submitted', true);
    }

    public function scopeSubmittedDuringLastWeek($query)
    {
        $query->owns()->where('has_submitted', true)->where('submitted_on', '>=', last_week());
    }

    public function scopePending($query)
    {
        $query->owns()->where('has_submitted', false);
    }

    public function scopeOwns($query)
    {
        $query->where('user_id', auth()->id());
    }

    //== INTERVIEW CONTROLLER >> JOBLIST(): FIND ALL JOBS THAT ARE NOT CLOSED AND AN APPLICATION HAD BEEN SUBMITTED
  //====================
    public function inUse()
    {
      $job = $this->job;
      return $job->interviews->count();
    }

    public function archive()
    {
      return $this->update(['has_turned_down' => true]);
    }

    //== APPLICATION CONTROLLER >> DESTROY: VERIFY NOT ASSOCIATED WITH AN UPCOMING INTERVIEW BEFORE DELETING
  //====================
    public function isInUse()
    {
      $job = $this->job;
      if($job->interview)
      {
        return $job->jobHasUpcomingInterview();
      }
      return false;
    }

    //== APPLICATION CONTROLLER >> DESTROY: IF ASSOCIATED WITH A PAST INTERVIEW RECORD THEN ARCHIVE APPLICATION
  //====================
    public function pastUse()
    {
      $job = $this->job;
      if($job->interview)
      {
        if($job->jobHadPastInterview())
        {
          return $this->archive();
        }
      }
      return false;
    }

    //== RELATIONSHIPS
   //====================
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function correspondences()
    {
        return $this->hasMany(Correspondence::class);
    }
}
