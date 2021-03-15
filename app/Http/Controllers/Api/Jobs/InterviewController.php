<?php

namespace App\Http\Controllers\Api\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Jobs\{Interview, Submission};
use App\Http\Resources\Jobs\InterviewResource;

class InterviewController extends Controller
{
  public function index()
  {
    $interviews = Interview::with('submission')->get();

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
    if( request()->wantsJson() )
    {
      return response()->json([
        'status' => 200,
        'message' => "OK",
        'redirect' => '/jobs/interviews'
      ]);
    }
  }

  public function destroy(Intervieww $interview)
  {
    $interview->delete();

    return response()->json(['status' => 200]);
  }
}
