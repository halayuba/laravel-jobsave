<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Offer extends Model
{
  protected $guarded = ['job_id', 'user_id'];

  protected $dates = ['date'];

  public function scopeOwns($query)
  {
      $query->where('user_id', auth()->id());
  }

  public function scopeMostRecent($query)
  {
      $query->where('is_archived', false)
        ->owns()->orderBy('date', 'desc');
  }

  public function accepted()
  {
    $this->update(['is_accepted' => true]);
  }

  public function rejected()
  {
    $this->update(['is_archived' => true, 'is_accepted' => false]);
  }

  public function archive()
  {
    $this->rejected();
  }

  ///== FILTERS
  //====================
  public function scopeFilter($query, $filters)
  {
    if($filters['filter'])
    {
      if($filters['filter'] == 'rejected'){
        $query->owns()->where('is_archived', true);
      }
    }
    // else $query->mostRecent();
  }

  ///== OFFER >> statusUpdateAccept()
  //====================
  public function confirmJobNotClosed()
  {
      return !$this->job->has_closed && !$this->is_accepted && !$this->is_archived;
  }

  ///== OFFER >> statusUpdateAccept()
  //====================
  public function btnRejectOffer()
  {
      return !$this->job->has_closed && !$this->is_archived;
  }

  ///== APPSERVICEPROVIDER >> OFFERS ICON
  //====================
  public function scopeOffersIcon($query)
  {
    $query->join('jobs', 'offers.job_id', '=', 'jobs.id')
          ->join('applications', 'jobs.id', '=', 'applications.job_id')
          ->select(\DB::raw('count(*)'))
          ->where('offers.is_archived', false)
          ->where('jobs.has_closed', false)
          ->where('applications.has_turned_down', false)
          ->where('offers.user_id', auth()->id());
  }

    //== RELATIONSHIPS
   //====================
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
