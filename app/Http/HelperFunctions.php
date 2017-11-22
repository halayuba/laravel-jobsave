<?php
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

  function flash_message($state, $msg)
  {
    session()->flash('state', $state);
    session()->flash('message', $msg);
  }

  function notification_state()
  {
    if(session('state') == 'success') return 'is-success';
    elseif(session('state') == 'warning') return 'is-warning';
    elseif(session('state') == 'danger') return 'is-danger';
    elseif(session('state') == 'info') return 'is-info';
    elseif(session('state') == 'default') return '';
  }

    //== HEADER MAIN NAVIGATION
   //====================
  function current_page($passed_value = '/')
  {
    $uri = request()->path(); //e.g., applications/create/59ecf885eeea5
    // $array = ['resumes', 'employers', 'jobs', 'accounts', 'interviews', 'applications', 'offers'];
    $array = ['overview', 'home', '/'];

    if($passed_value == $uri ) return 'is-active';
    elseif($passed_value == 'overview' && str_contains($uri, $passed_value)) return 'is-active';
    elseif($passed_value == '/' && $uri == 'home') return 'is-active';
    elseif(!in_array($uri, $array) && str_contains($uri, $passed_value) && $passed_value == 'dashboard') return 'is-active';
    // {
    //   return ($passed_value == 'dashboard')? 'is-active' : '';
    // }
    // elseif(!in_array($passed_value, $array)) return 'is-active';
    // elseif(in_array(starts_with($uri, $passed_value), $array))
    // {
    //   return ($passed_value == 'dashboard')? 'is-active' : '';
    // }
      // return ($passed_value == $uri)? 'is-active' : '';
  }

    //== SIDE NAVIGATION PANEL
   //====================
  function side_nav($uri)
  {
    return starts_with(request()->path(), $uri)? 'is_active' : ''; //strstr
    // return ends_with(request()->path(), $uri)? 'is_active' : '';
  }

   //== JOBS >> INDEX: SHOW LINK ONLY IF NAVIGATED FROM EMPLOYER PAGE
 //====================
  function jobs_indexed_by_employer()
  {
    return strstr(request()->path(), 'employers');
  }

  function loop_errors($errors)
  {
    // $result = '';
    $result = '<ul>';
    foreach ($errors->all() as $error) {
      $result .= '<li>'.$error.'</li>';
    }
    return $result .= '</ul>';
  }

  //== USED FOR ICONS TO VERIFY IF NOT TRUE WILL RETURN #DDD
 //====================
 function confirm_status($check)
 {
   return $check? '' : 'is_inactive';
 }

  //== USED TO ASSIGN "DISABLED" TO [Add submittal details] BUTTON IN JOBS.INDEX
 //====================
 function disbabled_button($check)
 {
   return $check? 'disabled' : '';
 }

  //== USED TO ASSIGN CLASS "BUTTON" TO [A] TAG IN RESUME.INDEX
 //====================
 function button_class($check)
 {
   return $check? 'button' : '';
 }

   //== CONCATINATE
  //====================
 function str_combine($str1, $str2)
 {
   return $str1.'/'.$str2;
 }

   //== APPLICATION.INDEX: DETERMINE PARTIAL OR COMPLETE SUBMISSION
  //====================
  function submission($val)
  {
    return ($val)? 'Complete' : 'Partial';
  }

   //== APPLICATION.INDEX: HAS APPLICATION BEEN REJECTED
  //====================
  function rejection($val)
  {
    return ($val)? 'Rejected' : 'No response';
  }

    //== RETURN VALUE IF EXISTS OR "NOT PROVIDED"
   //====================
   function valueOrText($val)
   {
		if(isset($val) && !empty($val)) return $val;
		else return 'Not provided';
	 }

    //== RETURN 'VALUE' IF EXISTS OR "PLACEHOLDER"
   //====================
   function valueOrPlaceholder($val, $placeholder)
   {
		if(isset($val) && !empty($val))
    {
      return 'value="'.$val.'"';
    }
		else return 'placeholder="'.$placeholder.'"';
	 }

    //== RETURN 'OLD' OR 'VALUE' IF EXISTS OR "PLACEHOLDER"
   //====================
   function oldOrValueOrPlaceholder($field, $val, $placeholder)
   {
      if(!empty(old($field)))
      {
        return 'value="'.old($field).'"';
      }
      elseif(isset($val) && !empty($val))
      {
        return 'value="'.$val.'"';
      }
      else return 'placeholder="'.$placeholder.'"';
	 }

    //== VERIFY IF FILE UPLOAD IS IMAGE
  //====================
   function is_image($file_type='')
   {
  		if(!empty($file_type))
      {
        $uploads_allowed = ['pjpeg', 'jpeg', 'JPG', 'X-PNG', 'PNG', 'png', 'x-png', 'gif', 'GIF'];
        return in_array($file_type, $uploads_allowed);
      }
      else return false;
   }

      //== DETERMINE SINGULAR / PLURAL / NONE. EXAMPLE: JOB, JOBS, ''
    //====================
    function wording($count, $word)
    {
      if($count > 1) return $count.' '.str_plural($word);
      if($count > 0) return '1 '.$word;
      if($count == 0) return 'No '.str_plural($word);
    }

      //== DETERMINE IF FILE UPLOAD IS PRESENT
    //====================
    function is_upload_present($check)
    {
      if($check) return str_after($check, 'public/jobs/');
      else return "Not provided";
    }

     //== OVERVIEW: HAS APPLICATION BEEN REJECTED OR NO RESPONSE
    //====================
    function application_status($val)
    {
      if($val)
      {
        return '<span class="tag is-danger">Turned down</span>';
      }

      return '<span class="tag is-warning">No response</span>';
    }

     //== OVERVIEW: HAS AN OFFER BEEN RECEIVED
    //====================
    // function offer($val)
    // {
    //   if($val)
    //   {
    //     return '<span class="tag is-danger">Turned down</span>';
    //   }
    // }

     //== JOBS & INTERVIEW >> SET FILTER NAVIGATION CLASS
   //====================
    function set_nav_active($check)
    {
      $filter = str_after($_SERVER['QUERY_STRING'], "filter=");

      if($filter && !empty($check))
      {
        return $filter == $check ? 'is-light' : 'is-white';
      }
      elseif(!$filter && empty($check)) return 'is-light';

      else return 'is-white';
    }

    function set_filter_active($val)
    {
      $uri = request()->path();
      return ends_with($uri, $val)? 'is-light' : 'is-white';;
    }

    function current_date($format = 'Y-m-d')
    {
      $d = new DateTime();
      $tz = new DateTimeZone('America/Chicago');
      $d->setTimezone($tz);
      return $d->format($format);
    }

    //RETURN DATE = 30 DAYS AGO
    function last_month()
    {
      return Carbon::today()->subMonth()->toDateString();
    }

    //RETURN DATE = 7 DAYS AGO
    function last_week()
    {
      return Carbon::today()->subWeek()->toDateString();
    }

    function formatDateTime($date, $format='Y-m-d') // 'M j, Y' || 'g:i a'
  	{
      if($date)
      {
        $dt = new DateTime($date);
        return $dt->format($format);
      }
      else return 'Not provided';
  		// $dt->setTimezone(new DateTimeZone('America/Chicago'));
  	}

  // FIND TIME DIFFERENCE BETWEEN 2 DATES
  function compareDates($date1, $date2)
  {
    $date1 = new DateTime($date1);
    $date2 = new DateTime($date2);
    $interval = $date2->diff($date1);

    if($interval->days == 0) return "Both dates are the same" ;

    else return ($date2 > $date1)? "2nd Date is greater" : "1st Date is greater";
    // return ($interval->days > 0)? "true" : "false";
  }

  // DATE 2 ON OR AFTER DATE 1
  function date2_onOrAfter_date1($date1, $date2)
  {
    $date1 = new DateTime($date1);
    $date2 = new DateTime($date2);

    return $date2 >= $date1;
  }

  // FIND IF PROVIDED DATE IS EQUAL TO TODAY OR IN THE FUTURE
  function on_or_after($date)
  {
    $date1 = current_date();
    $date2 = formatDateTime($date);
    return $date2 >= $date1;
  }

  // FIND IF PROVIDED DATE IS EQUAL TO TODAY OR IN THE FUTURE
  function on_or_after_lastWeek($date)
  {
    $date1 = last_week();
    $date2 = formatDateTime($date);
    return $date2 >= $date1;
  }

  // FIND IF PROVIDED DATE IS EQUAL TO TODAY OR IN THE PAST
  function on_or_before($date)
  {
    $today = current_date();
    $xdate = formatDateTime($date);
    return $xdate <= $today;
  }

   //== FUNCTION WILL RETURN "SELECTED" USED IN FORM LOOKUP SELECT LIST
   //====================
   function selected($old, $compare_to, $stored='')
   {
     if(!empty($stored))
     {
       //== USE THE OLD VALUE OF THE FORM FIELD IF EXITS OR USE THE STORED VALUE: BOTH ARE PASSED TO THIS FUNCTION
       //====================
       $val = (isset($old) && !empty($old))? $old : $stored;
       return ($val == $compare_to)? ' selected' : '';
     }
     else return ($old == $compare_to)? ' selected' : '';
   }

     //== DOES A JOB HAVE AN UPCOMING INTERVIEW USED IN THE NEXT FUNCTION
   //====================
    function job_has_interviews($id)
    {
      $result = DB::table('interviews')
                ->where('job_id', $id)
                ->where('is_canceled', false)
                ->whereRaw('DATE(date) >= '.current_date())
                ->count();
      return $result;
    }

    function twoTestsToDisableButton($check, $id)
    {
      if($check) return 'disabled';
      elseif(job_has_interviews($id) > 0) return 'disabled';
      else return '';
    }

    function createInterviewButton($id)
    {
      if(job_has_interviews($id) > 0) return false;
      else return true;
    }

    //== TRIM URL
   //====================
   function clean_url($url)
   {
     $url = str_after($url, 'http://www.');
     $url = str_after($url, 'https://www.');
     return (strlen($url)<=30)? $url : substr($url,0,30)."...";
   }

    //== TRUNCATE LONG FIELDS
   //====================
   function truncate_field($text, $val=30)
   {
     $text = trim($text);
     return (strlen($text) <= $val)? $text : substr($text ,0 , $val)."...";
   }

   ///== OVERVIEW: IF STATEMENT TO SHOW TABLE HEADER AND CONTENT
   //====================
   function confirm_filter($val)
   {
     if(isset($val))
     {
       if(count($val)) return true;
     }
     return false;
   }
