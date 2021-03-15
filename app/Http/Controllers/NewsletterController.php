<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Newsletter;
use App\Http\Helpers\notifications;
// use App\Http\Requests\NewsletterRequest;
use App\Http\Helpers\alerts;

class NewsletterController extends Controller
{
  public function store(Request $request)
    {
      $request = request()->validate([
        'email' => 'required|email|unique:newsletters',
      ]);

      Newsletter::create($request);

      return back()->with(alerts::flash_message('/home', 'success', 'Thank you for joining our newsletter.'));

    }
}
