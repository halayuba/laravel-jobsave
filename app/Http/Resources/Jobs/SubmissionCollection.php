<?php

namespace App\Http\Resources\Jobs;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Jobs\SubmissionResource;

use App\Models\Jobs\{Submission, Interview};
use App\Models\User;

class SubmissionCollection extends ResourceCollection
{
  public $collects = SubmissionResource::class;

  public function toArray($request)
  {
    /* == FOR THE DEMO: IF NO ONE IS SIGNED IN THEN ASSUME THE ADMIN IS SIGNED IN == */
    $user = auth()->user() ?: User::find(1);
    $interviews = $user->interviews()
      ->where('interviews.status', 'Completed')
      ->count();

    return [
      'data' => $this->collection,
      'count' => [
        'upcomingInterviews' => Submission::upcomingInterviews()->count(),
        'totalSubmissionsThisWeek' => Submission::submissionsSinceLastWeek()->count(),
        'submissionsHaveInterviews' => Submission::submissionsHaveInterviews()->count(),
        'filteredSubmissions' => Submission::filteredSubmissions()->get(),
        'completedInterviews' => $interviews
        // 'completedInterviews' => Interview::completedInterviews()->count() //== IF SINGLE USER APP
      ],
    ];
  }
}
