<?php

namespace App\Http\Resources\Jobs;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Jobs\SubmissionBasicResource;

class InterviewResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'date' => $this->date,
      'time' => $this->time,
      'dateTime' => $this->interviewDateTime,
      'interviewer' => $this->interviewer,
      'url' => $this->url,
      'notes' => $this->notes,
      'status' => $this->status,
      'submission' => new SubmissionBasicResource($this->whenLoaded('submission')),
    ];
  }
}
