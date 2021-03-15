<?php

namespace App\Http\Resources\Jobs;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\Jobs\InterviewResource;

class SubmissionResource extends JsonResource
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
        'company' => $this->company,
        'location' => $this->location,
        'position' => $this->position,
        'url' => $this->url,
        'note' => $this->note,
        'status' => $this->status,
        'created_at' => $this->created_at,
        'interviews' => InterviewResource::collection($this->interviews)
      ];
    }
}
