<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Carbon\Carbon;

class Job extends Model
{
    protected $guarded = ['id', 'user_id'];

    protected $dates = ['date_posted'];

      //== FOR APPLICATIONS
     //====================
     public function scopeHasApplication($query)
     {
       $query->whereHas('application', function($q)
       {
         $q->orderBy('submitted_on', 'desc');
       });
     }

     public function scopeJobOwnerHasApplication($query)
     {
       $query->whereHas('application', function($q)
       {
         $q->orderBy('submitted_on', 'desc');
       })->owns();
     }

     public function scopeApplicationChain($query)
     {
       $query->whereHas('application', function($q)
       {
         $q->orderBy('submitted_on', 'desc');
       })->owns()->with(['employer', 'application', 'interviews']);
     }

     //== APPLICATIONS
    //====================
     public static function query_all_withSort($var='')
     {
       if($var === 'current') $condition = ' AND DATE(a.submitted_on) > "'.last_month().'"';
       elseif($var === 'past') $condition = ' AND DATE(a.submitted_on) <= "'.last_month().'"';
       elseif($var === 'rejected') $condition = " AND a.has_turned_down = 1 ";
       else $condition = "";

       $result = DB::select('
          SELECT j.id job_id, j.title Job, j.identifier JobID, j.has_closed, e.name Employer, r.title Resume, a.id AppID, a.submitted_on, a.notes, a.has_submitted, a.has_turned_down
          FROM jobs as j, applications as a, resumes as r, employers as e
          WHERE j.user_id = '.auth()->id().' AND
          j.id = a.job_id AND a.resume_id = r.id AND j.employer_id = e.id'
          .$condition.'
          ORDER BY a.has_turned_down, a.submitted_on DESC;
       ');
       return collect($result);
     }

    //== INTERVIEW CONTROLLER >> JOBLIST(): FIND ALL JOBS THAT ARE NOT CLOSED AND AN APPLICATION HAD BEEN SUBMITTED
  //====================
    public function scopeSubmittedJobs($query)
    {
        $query->where('has_closed', false)
               ->wherehas('application', function($q){
                 $q->where('has_submitted', true)->where('has_turned_down', false);
               })
               ->owns()
               ->with('employer', 'application', 'interviews');
    }

    //== OVERVIEW: WILL USE FOLLOWING INSTEAD OF ABOVE BECAUSE ABOVE IS NOT PRODUCING A SORTED RESULT
   //====================
   //

    public function scopeUpcomingInterviewsWithSort($query)
    {
      $query->join('applications', 'jobs.id', '=', 'applications.job_id')
            ->join('employers', 'jobs.employer_id', '=', 'employers.id')
            ->join('interviews', 'jobs.id', '=', 'interviews.job_id')
            ->select('jobs.title', 'jobs.location', 'jobs.identifier', 'employers.name', 'applications.submitted_on', 'applications.has_turned_down', 'interviews.id', 'interviews.date', 'interviews.time', 'interviews.is_canceled', 'interviews.is_unsuccessful')
            ->where('jobs.user_id', auth()->id())
            ->where('interviews.date', '>=', current_date())
            ->orderBy('interviews.date', 'asc');
    }

    ///== OVERVIEW >> ->where('jobs.id', 29);
    //====================
    public function scopeOldInterviewsWithSort($query)
    {
        $query->select('jobs.identifier as jobID', 'jobs.title', 'jobs.location', 'employers.name', 'applications.submitted_on', 'applications.has_turned_down', 'interviews.id as interviewID', 'interviews.date', 'interviews.time', 'interviews.is_canceled', 'interviews.is_unsuccessful', 'offers.id as offerID', 'offers.date as offerDate', 'offers.is_accepted', 'offers.is_archived')
              ->join('applications', 'jobs.id', '=', 'applications.job_id')
              ->join('employers', 'jobs.employer_id', '=', 'employers.id')
              ->join('interviews', 'jobs.id', '=', 'interviews.job_id')
              ->leftJoin('offers', 'jobs.id', '=', 'offers.job_id')
              ->where('jobs.user_id', auth()->id())
              ->where('interviews.date', '<', current_date())
              ->orderBy('interviews.date', 'desc');
      }

    ///== OVERVIEW
    //====================
    public function scopeUnsuccessfulApplications($query)
    {
        $query->where('has_closed', true)
               ->Wherehas('application', function($q){
                 $q->where('has_submitted', true)->where('has_turned_down', true);
               })
               ->orWherehas('interviews', function($q){
                 $q->where('is_canceled', true)->orWhere('is_unsuccessful', true);
               })
               ->owns()
               ->with('employer', 'application', 'interviews');
     }

      //== OVERVIEW >> SUBMITTED APPLICATIONS WITH NO INTERVIEWS
    //====================
      public static function submittedApplicationsWithNoInterviews()
      {
        $jobs = Job::owns()->whereHas('application', function($q)
        {
          $q->orderBy('submitted_on', 'desc');
        })->with('employer')->get();

        $jobs = $jobs->filter(function($job){
          if($job->interviews->count()) return false;
          else return true;
        });
        return $jobs;
      }

     //== JOB FILTER: JOBS THAT HAD NOT BEEN SUBMITTED NORE CLOSED
   //====================
    public function scopeOpenJobs($query)
    {
        $query->owns()->where('has_submitted', false)->where('has_closed', false);
    }

    ///== OFFERS: JOBS WITH SUCCESSFUL INTERVIEWS
    //====================
      public function scopeJobsListWithInterviews($query)
      {
          $query->where('has_closed', false)
                 ->Wherehas('interviews', function($q){
                   $q->where('is_canceled', false)->Where('is_unsuccessful', false)->where('date', '<', current_date());
                 })
                 ->owns()
                 ->with('employer', 'application', 'interviews');
       }

      //== GENERAL
     //====================
    public function scopeUploadedFile($query, $filename)
    {
        $query->where('file', $filename);
    }

    ///== DETERMINE IF DUPLICATE RECORD
    //====================
    public function scopeJobTitle($query)
    {
        $query->where('title', request()->title)->where('location', request()->location)->where('user_id', auth()->id());
    }

    ///== DETERMINE IF DUPLICATE RECORD - UPDATING JOB
    //====================
    public function scopeConfirmDuplicateRecord($query, $id)
    {
        $query->where('title', request()->title)->where('location', request()->location)->where('user_id', auth()->id())->where('id', '!=', $id);
    }

    ///== LATEST JOBS GT LAST WEEK
    //====================
    public function scopeCurrentJobs($query)
    {
        $query->where('has_closed', false)
              ->where('jobs.user_id', auth()->id())
              ->where('created_at', '>=', Carbon::today()->subWeek())
              ->latest();
    }

    public function scopeCurrent($query)
    {
        $query->join('employers', 'jobs.employer_id', '=', 'employers.id')
              ->where('has_closed', false)
              ->where('jobs.user_id', auth()->id())
              ->orderBy('employers.name');
    }

    ///== FILTERS FOR JOB CONTROLLER
    //====================
    public function scopeJobFilters($query, $filters)
    {
      if($filters['filter'])
      {
        if($filters['filter'] == 'bookmarked'){
          $query->owns()->where('is_bookmarked', true)->where('has_closed', false);
        }
        elseif($filters['filter'] == 'closed'){
          $query->owns()->where('has_closed', true);
        }
        elseif($filters['filter'] == 'not-submitted'){
          $query->openJobs();
        }
        elseif($filters['filter'] == 'current'){
          $query->currentJobs();
        }
      }
      else $query->current();
    }

    ///== FILTERS FOR APPLICATION CONTROLLER
    //====================
    public function scopeApplicationFilters($query, $filters)
    {
      if($filters['filter'])
      {
        if($filters['filter'] == 'current'){
          return self::query_all_withSort('current');
        }
        elseif($filters['filter'] == 'past'){
          return self::query_all_withSort('past');
        }
        elseif($filters['filter'] == 'rejected'){
          return self::query_all_withSort('rejected');
        }
      }
      else $query->current();
    }

    ///== (NOT USED) APPLICATION >> INDEX >> ICON FOR INTERVIEW: DOES A JOB HAVE AN UPCOMING INTERVIEW
    //====================
    public function btn_for_interview()
    {
      if($this->has_closed) return false;

      $interview = $this->interviews->last();
      if($interview)
      {
        if(!$interview->is_canceled && on_or_after($interview->date)) return false;
        else return true;
      }
      else return true;
    }

    public function scopeOwns($query)
    {
        $query->where('user_id', auth()->id());
    }

    public function fileUploadExists($val)
    {
      return $this->uploadedFile($val)->count();
    }

    public function duplicateRecord()
    {
      return $this->jobTitle()->count();
    }

    public function duplicateRecordUpdating($id)
    {
      return $this->confirmDuplicateRecord($id)->count();
    }

    public function inUse()
    {
      return ($this->application !== NULL && $this->application->count());
    }

    public function hasNoUpload()
    {
      return $this->file == NULL;
    }

    public function jobHasUpcomingInterview()
    {
      $interview = $this->interviews->last();
      return $interview? on_or_after($interview->date) : false;
    }

    public function jobHadPastInterview()
    {
      $interview = $this->interviews->last();
      return $interview? on_or_before($interview->date) : false;
    }

    public function getLastInterviewDateTime($id)
    {
      $job = Job::find($id);
      $interview = $job->interviews->last();
      return formatDateTime($interview->date, 'M j, Y').' @ '.formatDateTime($interview->time, 'g:i a');
    }

    public function archive()
    {
      $this->update(['has_closed' => true]);
    }

    public function makeSubmitted()
    {
      $this->update(['has_submitted' => true]);
    }

    public function makeUnsubmitted()
    {
      $this->update(['has_submitted' => false]);
    }

    //== RELATIONSHIPS
   //====================
    public function interviews()
    {
        return $this->hasMany(Interview::class);
    }

    public function application()
    {
        return $this->hasOne(Application::class);
    }

    public function offer()
    {
        return $this->hasOne(Offer::class);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function employment_type()
    {
        return $this->belongsTo(Employment_type::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job_role()
    {
        return $this->belongsTo(Job_role::class);
    }

    public function job_poster()
    {
        return $this->belongsTo(Job_poster::class);
    }

    public function uploads()
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }

}
