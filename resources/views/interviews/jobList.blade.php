@extends('layouts.master')

@section('title', 'Job Interview')

@section('hero')
  <hero-dashboard
    header="List of jobs you've already applied for"
    subheader='This view displays jobs with completed application submissions. From this list, select to create a record for an upcoming interview (you can also create a new interview from an application that you have already completed).'
  >
  </hero-dashboard>
@endsection

@section('content')

  @if(count($jobs))
    <div class="columns is-multiline">
      @foreach($jobs as $job)
        <div class="column is-one-third">

          <div class="card">
            <div class="card-content">

              <!-- JOB TITLE -->
              <p class="title">
                <a href="{{ route('jobs.show', $job->identifier) }}">{{ $job->title }}</a>
              </p>

              <!-- EMPLOYER NAME -->
              <p class="subtitle">
                <a href="{{ route('employers.show', $job->employer->name) }}">{{ $job->employer->name }}</a>
              </p>

              <!-- APPLICATION SUBMISSION DATE -->
              <p class="subtitle is-6">
                <span>
                  Application submitted on: {{ $job->application->submitted_on->toFormattedDateString() }}
                </span>
              </p>

              <!-- APPLICATION NOTES -->
              <small>{{ $job->application->notes }}</small>
            </div>

            @forelse($job->interviews as $interview)
              <!-- APPLICATIONS THAT HAVE UPCOMING INTERVIEW -->
              @if($interview->upcoming())
                <footer class="card-footer">
                  <div class="pda_1">
                    <div class="content">
                      <p class="title is-5">Upcoming Interview:</p>
                      <small>{{ $interview->date->toFormattedDateString() .' @' . formatDateTime($interview->time, 'g:i a') }}</small>
                    </div>
                  </div>
                </footer>

              <!-- PAST INTERVIEWS -->
              @elseif($interview->completed())
                <footer class="card-footer">
                  <div class="pda_1">
                    <div class="content">
                      <p class="title is-5">Past Interview:</p>
                      <small>{{ $interview->date->toFormattedDateString() .' @' . formatDateTime($interview->time, 'g:i a') }}</small>
                    </div>
                  </div>
                </footer>
                <footer class="card-footer">
                  <div class="card-footer-item">
                    <a href="{{ route('interviews.create', $job->identifier) }}" class="button is-primary">
                      <span class="icon">
                        <i class="ion-checkmark-circled size24"></i>
                      </span> &nbsp; &nbsp; Add interview appointment
                    </a>
                  </div>
                </footer>
              @endif

            <!-- WHEN NO INTERVIEWS  -->
            @empty
              <footer class="card-footer">
                <div class="card-footer-item">
                  <a href="{{ route('interviews.create', $job->identifier) }}" class="button is-primary">
                    <span class="icon">
                      <i class="ion-checkmark-circled size24"></i>
                    </span> &nbsp; &nbsp; Add interview appointment
                  </a>
                </div>
              </footer>
            @endforelse

          </div>
        </div>
      @endforeach
    </div>
  @else
    <alert-bulma msg="There isn't any jobs to file an application submission to! If you had previously created records for job postings then you either updated those jobs as CLOSED or SUBMITTED - referring to you flagging the jobs as no longer available or as having already submitted an application to. You can go back and click on [Create Content] then select the option [Add info about Job]" klass="is-warning"></alert-bulma>
  @endif

@endsection
