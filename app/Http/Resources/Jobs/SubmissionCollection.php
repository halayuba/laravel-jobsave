<?php

namespace App\Http\Resources\Jobs;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Jobs\SubmissionResource;

use App\Models\Jobs\{Submission, Interview};

class SubmissionCollection extends ResourceCollection
{
    public $collects = SubmissionResource::class;

    public function toArray($request)
    {
      return [
        'data' => $this->collection,
        'count' => [
          'upcomingInterviews' => Submission::upcomingInterviews()->count(),
          'totalSubmissionsThisWeek' => Submission::submissionsSinceLastWeek()->count(),
          'submissionsHaveInterviews' => Submission::submissionsHaveInterviews()->count(),
          'filteredSubmissions' => Submission::filteredSubmissions()->get(),
          'completedInterviews' => Interview::completedInterviews()->count()
        ],
      ];
    }
}
