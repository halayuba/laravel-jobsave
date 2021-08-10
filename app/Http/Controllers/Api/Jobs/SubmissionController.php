<?php

namespace App\Http\Controllers\Api\Jobs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Jobs\Submission;
use App\Models\User;
use App\Http\Resources\Jobs\{SubmissionResource, SubmissionCollection};

class SubmissionController extends Controller
{
  public function index(Request $request)
  {
    /* == FOR THE DEMO: IF NO ONE IS SIGNED IN THEN ASSUME THE ADMIN IS SIGNED IN == */
    $user = $request->user() ?: User::find(1);

    /* == FIND APPLICATION SUBMISSIONS THAT HAVE UPCOMING INTERVIEWS == */
    $submissionsWithUpcomingInterviews = $user->submissions()->upcomingInterviews()->get();

    /* == (NOT NEEDED) FIND APPLICATION SUBMISSIONS THAT ENDED UP WITH INTERVIEWS == */
    // $submissionsWithInterviews = Submission::setUpInterviews()->get();

    /* == (NOT NEEDED) FIND APPLICATION SUBMISSIONS WITH NO INTERVIEWS == */
    // $submissionsWithNoInterview = Submission::doesntHave('interviews')->latest()->get();

    /* == GET ALL SUBMISSION WITH PAST OR NO INTERVIEWS == */
    $submissionsWithPastOrNoInterviews = $user->submissions()->submissionsWithPastOrNoInterviews()->get();

    /* == CHECK IF NOT EMPTY THEN SHOW FIRST THE SUBMISSIONS THAT HAVE UPCOMING INTERVIEWS == */
    $submissions = $submissionsWithUpcomingInterviews->isNotEmpty() ?
      /* == CONCAT: to appends the collection's values onto the end of first collection (I'M INTERESTED IN THE SORT ORDER HERE) == */
      $submissionsWithUpcomingInterviews->concat($submissionsWithPastOrNoInterviews) : $submissionsWithPastOrNoInterviews;

    /* == MUST USE "UNIQUE" BECAUSE MULTIPLE RECORDS WITH THE SAME ID WILL SHOW IF ONE OF THE JOB SUBMISSIONS HAD MORE THAN ONE JOB INTERVIEW ASSOCIATED WITH IT == */
    return new SubmissionCollection($submissions->unique('id')->flatten()); //== IT WILL NOT WORK WITHOUT FLATTEN() THE RESULT
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
    if (Submission::findDuplicateRecord()->exists())
    {
      return response()->json([
        'status' => 409,
        'message' => "Conflict. This is a duplicate entry"
      ]);
    }
    else
    {
      $request->user()->submissions()->create($attributes + [
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
    if ($job->NotUniqueForUpdate())
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
    /* == DOES THE JOB SUBMISSION TO BE UPDATED HAVE AN UPCOMING INTERVIEW == */
    if( $job->interviews->count() )
    {
      if( $job->hasUpcomingInterviews()->count() )
      {
        $interviewId = $job->getInterviewId()->get()->flatten()->pluck('id');
        $interview = Interview::find($interviewId)->first();
        $interview->canceled();
      }
    }

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
    /* == DOES THE JOB SUBMISSION TO BE DELETED HAVE INTERVIEWS (AND OFFERS) == */
    if ($job->interviews)
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

    /* == CONFIRM THIS JOB SUBMISSION HAS NO "UPCOMING" INTERVIEW == */
    if( $job->interviews && $job->hasUpcomingInterviews($job->id)->count() )
    {
      return response()->json([
        'success' => false,
        'message' => 'This job submission already has an upcoming interview and as a business rule you can only have one upcoming interview.'
      ]);
    }

    $job->interviews()->create($attributes + [
      'interviewer' => $request->interviewer,
      'url' => $request->url,
      'notes' => $request->notes
    ]);

    return response()->json([
      'success' => true,
      'message' => 'New interview created successfully.'
    ]);
  }
}
