@foreach($jobsWithPastInterviews as $job)
  <div class="columns is_color11">

    <!-- EMPLOYER NAME -->
    <div class="column is-2">
      <p class="subtitle is-5">
        <a href="{{ route('employers.show', $job->name) }}">{{ $job->name }}</a>
      </p>
    </div>

    <!-- JOB TITLE -->
    <div class="column is-2">
      <p class="subtitle is-5">
        <a href="{{ route('jobs.show', $job->identifier) }}">{{ $job->title }}</a>
      </p>
    </div>

    <!-- JOB LOCATION -->
    <div class="column is-2">
      <p class="subtitle is-6">
        {{ $job->location }}
      </p>
    </div>

    <!-- APPLICATION SUBMISSION DATE -->
    <div class="column is-2">
      <p class="subtitle is-6">{{ formatDateTime($job->submitted_on, 'M j, Y') }}</p>
    </div>

    <!-- INTERVIEW DETAILS & STATUS -->
    <div class="column is-2">
      <p class="subtitle is-6">
          @if($job->is_canceled)
            <span class="tag is-danger">Canceled</span><br>
          @elseif($job->is_unsuccessful)
            <span class="tag is-danger">Unsuccessful</span><br>
          @endif
          {{ formatDateTime($job->date, 'M j, Y') }}
            <a href="{{ url('interviews/'.$job->interviewID.'/jobs/'.$job->jobID) }}" class="css_a">
              <span class="icon">
                <i class="fa fa-eye size24"></i>
              </span>
            </a>
          <br>
          {{ formatDateTime($job->time, 'g:i a') }}
      </p>
    </div>

    <!-- APPLICATION / OFFER STATUS -->
    <div class="column">
      @if($job->id)
        <div class="level-item has-text-centered">
          @if($job->is_accepted)
            <div class="box notification is-success">
              <p class="title is-6">Offer Accepted</p>
              <p class="heading">{{ $job->offerDate }}</p>
            </div>
          @elseif($job->is_archived)
            <div class="box notification is-warning">
              <p class="title is-6">Offer Rejected</p>
              <p class="heading">{{ $job->offerDate }}</p>
            </div>
          @endif
        </div>
      @else
        <p class="subtitle is-6">{!! application_status($job->has_turned_down) !!}</p>
      @endif
    </div>
  </div>
  <div class="notification"></div>
@endforeach
