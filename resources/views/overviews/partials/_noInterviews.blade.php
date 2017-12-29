@foreach($jobsWithNoInterviews as $job)
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
          {{"...."}}
      </p>
    </div>
    <div class="column">
      <p class="subtitle is-6">{!! application_status($job->application->has_turned_down) !!}</p>
    </div>
  </div>
  <div class="notification"></div>
@endforeach
