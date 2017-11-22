<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Events\ActivationEmailRequested;

use App\Events\NewUserAccountActivation;

class ActivationController extends Controller
{
  public function activate(Request $request)
  {
    $user = User::where('email', $request->email)
            ->where('activation_token', $request->token)
            ->firstOrFail();

    $user->update([
      'is_active' => true,
      'activation_token' => NULL
    ]);

    \Auth::loginUsingId($user->id);

    event(new NewUserAccountActivation($user));

    return redirect('/dashboard')->with(flash_message('is-success', 'Congratulations, you have successfully verified the Registrant email address. '. $user->name .', you\'re now signed in!'));

  }

  public function activation_resend_form()
  {
    return view("auth.activation.resend");
  }

  public function activation_resend(Request $request)
  {
    $this->validate(request(), [
        'email' => 'required|email|exists:users,email'
    ], [
      'email.exists' => 'Could not find that account!'
    ]);

    $user = User::where('email', $request->email)->first();

    //== SEND VERIFICATION EMAIL
  //====================
   event(new ActivationEmailRequested($user));

    return redirect('/login')->with(flash_message("is-success", "An email has been sent for account activation."));

  }



}
