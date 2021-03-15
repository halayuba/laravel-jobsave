<?php

namespace App\Http\Controllers\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Jobs\Submission;

class SubmissionController extends Controller
{
    public function index()
    {
      $submissions = Submission::all();
      return view("jobs.submissions.index", compact('submissions'));
    }
}
