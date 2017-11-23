<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $guarded = ['id', 'user_id'];

    public function inUse()
    {
      return ($this->jobs !== NULL && $this->jobs->count());
    }

    public function scopeCurrent($query)
    {
        $query->owns()->where('is_archived', false)->latest();
    }

    public function scopeOwns($query)
    {
        $query->where('user_id', auth()->id());
    }

    ///== FILTER
    //====================
    public function scopeFilter($query, $filters)
    {
      if($filters['filter'])
      {
        if($filters['filter'] == 'archived'){
          $query->owns()->where('is_archived', true);
        }
      }
      else $query->current();
    }

    ///== DETERMINE IF DUPLICATE RECORD
    //====================
    public function scopeIsDuplicate($query)
    {
        $query->where('name', request()->name)->where('user_id', auth()->id());
    }

    public function archive()
    {
      $this->update(['is_archived' => true]);
    }

    public function activate()
    {
      $this->update(['is_archived' => false]);
    }

  //== RELATIONSHIPS
 //====================
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function job_posters()
    {
        return $this->hasMany(Job_poster::class);
    }

    public function account()
    {
      return $this->hasOne(Account::class);
    }

    public function Industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
