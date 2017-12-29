@foreach($jobsWithUpcomingInterviews as $job)
  <div class="columns is_color11">
    <div class="column is-2">
      <p class="subtitle is-5">
        <a href="{{ route('employers.show', $job->name) }}">{{ $job->name }}</a>
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
      <p class="subtitle is-6">{{ formatDateTime($job->submitted_on, 'M j, Y') }}</p>
    </div>
    <div class="column is-2">
      <p class="subtitle is-6">
          @if($job->is_canceled)
            <span class="tag is-danger">Canceled</span><br>
          @endif
          {{ formatDateTime($job->date, 'M j, Y') }}
            <a href="{{ url('interviews/'.$job->id.'/jobs/'.$job->identifier) }}" class="css_a">
              <span class="icon">
                <i class="fa fa-eye size24"></i>
              </span>
            </a>
          <br>
          {{ formatDateTime($job->time, 'g:i a') }}
      </p>
    </div>
    <div class="column">
      <p class="subtitle is-6">{!! application_status($job->has_turned_down) !!}</p>
    </div>
  </div>
  <div class="notification"></div>
@endforeach
