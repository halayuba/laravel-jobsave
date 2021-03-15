<?php

namespace App\Http\Controllers\Api\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Jobs\Submission;
use App\Http\Resources\Jobs\{SubmissionResource, SubmissionCollection};

class SubmissionController extends Controller
{
  public function index()
  {
    /* == FIND APPLICATION SUBMISSIONS THAT HAVE UPCOMING INTERVIEWS == */
    $submissionsWithUpcomingInterviews = Submission::upcomingInterviews()->get();

    /* == (NOT NEEDED) FIND APPLICATION SUBMISSIONS THAT ENDED UP WITH INTERVIEWS == */
    // $submissionsWithInterviews = Submission::setUpInterviews()->get();

    /* == (NOT NEEDED) FIND APPLICATION SUBMISSIONS WITH NO INTERVIEWS == */
    // $submissionsWithNoInterview = Submission::doesntHave('interviews')->latest()->get();

    /* == GET ALL SUBMISSION WITH PAST OR NO INTERVIEWS == */
    $submissionsWithPastOrNoInterviews = Submission::submissionsWithPastOrNoInterviews()->get();

    /* == CHECK IF NOT EMPTY THEN SHOW FIRST THE SUBMISSIONS THAT HAVE UPCOMING INTERVIEWS == */
    $submissions = $submissionsWithUpcomingInterviews->isNotEmpty() ?
      /* == CONCAT: to appends the collection's values onto the end of first collection (I'M INTERESTED IN THE SORT ORDER HERE) == */
      $submissionsWithUpcomingInterviews->concat($submissionsWithPastOrNoInterviews) : $submissionsWithPastOrNoInterviews;

    /* == MUST USE "UNIQUE" BECAUSE MULTIPLE RECORDS WITH THE SAME ID WILL SHOW IF ONE OF THE JOB SUBMISSIONS HAD MORE THAN ONE JOB INTERVIEW ASSOCIATED WITH IT == */
    return new SubmissionCollection($submissions->unique('id')->flatten()); //== IT WILL NOT WORK WITHOUT FLATTEN() THE RESULT

    /* OLD
    return SubmissionResource::collection($submissions);

    $submissions = Submission::with('interviews')->latest()->get();
    return SubmissionResource::collection($submissions);
    */
  }

   //== STORE A JOB SUBMISSION
  //====================
  public function store(Request $request)
  {
    $attributes = request()->validate([
      'company' => 'required',
      'location' => 'required',
      'position' => 'required'
    ]);

    /* == CONFIRM NOT A DUPLICATE ENTRY == */
    if(Submission::findDuplicateRecord()->exists())
    {
      return response()->json([
        'status' => 409,
        'message' => "Conflict. This is a duplicate entry"
      ]);
    }
    else
    {
      Submission::create($attributes + [
        'url' => $request->url,
        'note' => $request->note
      ]);

      // return SubmissionResource::collection(Submission::latest()->get());
      /* == SHOULD USE THE SAME TECHNIQUE USED IN THE INDEX ABOVE BUT THIS IS A DEMMO PROJECT == */
      return response()->json([
        'status' => 200,
        'message' => "OK",
        'redirect' => '/jobs'
      ]);
    }
  }

   //== UPDATE A JOB SUBMISSION
  //====================
  public function update(Request $request, Submission $job)
  {
    $attributes = request()->validate([
      'company' => 'required',
      'location' => 'required',
      'position' => 'required'
    ]);

    /* == CONFIRM NOT A DUPLICATE ENTRY == */
    if($job->NotUniqueForUpdate())
    {
      return response()->json([
        'status' => 409,
        'message' => "Conflict. This is a duplicate entry"
      ]);
    }
    else
    {
      $job->update($attributes + [
        'url' => $request->url,
        'note' => $request->note
      ]);

    // return SubmissionResource::collection(Submission::latest()->get());
    /* == SHOULD USE THE SAME TECHNIQUE USED IN THE INDEX ABOVE BUT THIS IS A DEMMO PROJECT == */
      return response()->json([
        'status' => 200,
        'message' => "OK"
      ]);
    }
  }

  public function updateToUnsuccessful(Submission $job)
  {
    $job->update([
      'status' => 'Unsuccessful'
    ]);

    return response()->json([
      'status' => 200,
      'message' => "OK"
    ]);
  }

  public function destroy(Request $request, Submission $job)
  {
    /* == IS THE JOB SUBMISSION TO BE DELETED HAS INTERVIEWS (AND OFFERS) == */
    if( $job->interviews )
    {
      $job->interviews->map->delete();
    }

    /* == DELETE JOB SUBMISSION == */
    $job->delete();

    return SubmissionResource::collection(Submission::latest()->get());

    // if( request()->wantsJson() ) return [ 'redirect' => '/jobs' ];
  }

   //== STORE DETAILS ABOUT AN INTERVIEW
  //====================
  public function storeInterviewDetail(Request $request, Submission $job)
  {
    $attributes = request()->validate([
      'date' => 'required',
      'time' => 'required',
    ]);

    $job->interviews()->create($attributes + [
      'interviewer' => $request->interviewer,
      'notes' => $request->notes
    ]);

    return response()->json(['status' => 200]);
  }
}
