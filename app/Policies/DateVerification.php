<?php

namespace App\Policies;

use Carbon\Carbon;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Job;

class DateVerification
{
    use HandlesAuthorization;

    protected $now, $submitted_on, $interview_date, $last_month;

    public function __construct()
    {
      $this->application_submitted_on = request()->submitted_on;
      $this->request_date = request()->date;
      $this->last_month = Carbon::today()->subMonth()->toDateString();
    }

    public function withinLastMonth($user, $val)
    {
        return (on_or_before($val) && $val >= $this->last_month);
    }

    ///== APPLICATION POLICY
    //====================
    public function acceptableRange($user, $job)
    {
      ///== APPLICATION->SUBMISSION MUST COME AFTER JOB->DATE_POSTED
      //====================
      $date1 = $job->date_posted; //JOB->DATE_POSTED
      $date2 = $this->application_submitted_on; //APPLICATION->SUBMISSION_0N
      $test_1 = date2_onOrAfter_date1($date1, $date2);

      ///== APPLICATION SUBMISSION NOT IN THE FUTURE - ALSO THE RANGE NEEDS TO BE WITHIN THE PAST MONTH
      //====================
      $test_2 = (on_or_before($date2) && $date2 >= $this->last_month)? true : false;

      return $test_1 && $test_2;
    }

     //== INTERVIEW POLICY
     //====================
    public function withinMonth($user, $job)
    {
      ///== INTERVIEW->DATE MUST COME AFTER APPLICATION->SUBMISSION
      //====================
      $application = $job->application;
      $date1 = $application->submitted_on; //APPLICATION->SUBMISSION_0N
      $date2 = $this->request_date; //INTERVIEW->DATE
      $test_1 = date2_onOrAfter_date1($date1, $date2);

      ///== AN INTERVIEW DATE MUST BE WITHIN A MONTH BEFORE OR A MONTH AFTER FROM TODAY
      //====================
      $boundary1 = Carbon::today()->addMonth()->toDateString();
      $boundary2 = Carbon::today()->subMonth()->toDateString();
      $test_2 = $boundary1 > $date2 && $date2 > $boundary2;

      return $test_1 && $test_2;
    }

    ///== OFFERS POLICY
    //====================
    public function offersPolicy($user, $job)
    {
      ///== OFFER DATE MUST COME AFTER INTERVIEW DATE
      //====================
      $interview = $job->interviews->last();
      $date1 = $interview->date; //INTERVIEW->DATE
      $date2 = $this->request_date; //OFFER->DATE
      $test_1 = date2_onOrAfter_date1($date1, $date2);

      ///== OFFER RECEIVED CAN NOT BE IN THE FUTURE - ALSO THE RANGE NEEDS TO BE WITHIN THE PAST MONTH
      //====================
      $test_2 = on_or_before($date2) && $date2 >= $this->last_month;

      return $test_1 && $test_2;
    }

}
