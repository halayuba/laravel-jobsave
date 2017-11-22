@foreach($jobsWithNoSuccess as $job)
  <div class="columns is_color11">
    <div class="column is-2">
      <p class="subtitle is-5">
        <a href="{{ route('employers.show', $job->employer->name) }}">{{ $job->employer->name }}</a>
      </p>
    </div>
    <div class="column is-2">
      <p class="subtitle is-5">
        <a href="{{ route('jobs.show', $job->identifier) }}">{{ $job->title }}</a>
      </p>
    </div>
    <div class="column is-2">
      <p class="subtitle is-6">
        {{ $job->location }}
      </p>
    </div>
    <div class="column is-2">
      <p class="subtitle is-6">{{ formatDateTime($job->application->submitted_on, 'M j, Y') }}</p>
    </div>
    <div class="column is-2">
      <p class="subtitle is-6">
        @jobWithInterview($job->interviews)

          @if($job->interviews->last()->is_canceled)
            <span class="tag is-danger">Interview Canceled</span><br>
          @endif

          @if($job->interviews->last()->is_unsuccessful)
            <span class="tag is-warning">Unsuccessful interview</span><br>
          @endif

          {{ formatDateTime($job->interviews->last()->date, 'M j, Y') }}
          <a href="{{ url('interviews/'.$job->interviews->last()->id.'/jobs/'.$job->identifier) }}" class="css_a">
            <span class="icon">
              <i class="icon-eye size24"></i>
            </span>
          </a>
          <br>
          {{ formatDateTime($job->interviews->last()->time, 'g:i a') }}

        @endjobWithInterview
      </p>
    </div>
    <div class="column">
      <p class="subtitle is-6">{!! application_status($job->application->has_turned_down) !!}</p>
    </div>
  </div>
  <div class="notification"></div>
@endforeach
