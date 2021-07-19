<?php

namespace App\Http\Controllers\Api\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Jobs\{Interview, Submission};
use App\Models\User;
use App\Http\Resources\Jobs\InterviewResource;

class InterviewController extends Controller
{
  public function index()
  {
    /* == FOR THE DEMO: IF NO ONE IS SIGNED IN THEN ASSUME THE ADMIN IS SIGNED IN == */
    $user = auth()->user() ? auth()->user() : User::find(1);

    $interviews = $user->interviews()
      ->with('submission')
      ->orderBy('submission_id')
      ->get();

    return InterviewResource::collection($interviews);
  }

  public function update(Request $request, Interview $interview)
  {
    $attributes = request()->validate([
      'date' => 'required',
      'time' => 'required',
      'status' => 'required',
    ]);

    $interview->update($attributes + [
      'interviewer' => $request->interviewer,
      'notes' => $request->notes
    ]);

    return response()->json(['status' => 200]);
  }

  public function updateCompleted(Interview $interview)
  {
    $interview->completed();
    if (request()->wantsJson()) {
      return response()->json([
        'status' => 200,
        'message' => "OK",
        'redirect' => '/jobs/interviews'
      ]);
    }
  }

  public function destroy(Interview $interview)
  {
    $interview->delete();

    return response()->json(['status' => 200]);
  }
}
