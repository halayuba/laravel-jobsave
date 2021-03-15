<?php

namespace App\Http\Helpers;

class alerts
{
  public static function flash_message( $redirect, $state, $msg )
  {
    session()->flash('state', $state);
    session()->flash('message', $msg);
    session()->flash('redirect', $redirect);
  }

  public static function alert_state()
  {
    if(session('state') == 'success') return 'bg-green-500';
    elseif(session('state') == 'info') return 'bg-blue-500';
    elseif(session('state') == 'warning') return 'bg-yellow-500';
    elseif(session('state') == 'danger') return 'bg-red-500';
    // elseif(session('state') == 'default') return 'secondary';
    else return '';
  }

}
