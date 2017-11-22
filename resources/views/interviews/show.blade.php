@extends('layouts.master')

@section('title', 'Interview details')

@section('hero')
  <hero-dashboard
    header="Interview Details"
    subheader="Details of a job interview opportunity"
  >
  </hero-dashboard>
@endsection

@section('content')
  <div class="columns">
    <div class="column is-half is-offset-2">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title title is-4">
              <a href="{{ route('jobs.show', $job->identifier) }}">{{ $job->title }} </a>
              &nbsp;
              <i class="ion-more"></i> &nbsp;&nbsp;
              <a href="{{ route('employers.show', $job->employer->name) }}"> {{ $job->employer->name }}</a>
              @if($interview->is_canceled)
                &nbsp; &nbsp;<span class="tag is-danger"><strong>Canceled</strong></span>
              @elseif($interview->is_unsuccessful)
                &nbsp; &nbsp;<span class="tag is-danger"><strong>Unsuccessful</strong></span>
              @endif
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              <card-content klass="ion-android-calendar" label="Date of Interview" value="{{ $interview->date->toFormattedDateString() }}"></card-content>
              <card-content klass="ion-android-alarm-clock" label="Time of Interview" value="{{ formatDateTime($interview->time, 'g:i a') }}"></card-content>
              <card-content klass="ion-android-contacts" label="Interviewer(s)" value="{{ $interview->interviewer }}"></card-content>
              <card-content klass="ion-happy" label="Type of the Interview" value="{{ $interview->interview_type->type }}"></card-content>
            </div>
          </div>

          <footer class="card-footer">
            <div class="pda_1">
              <div class="content">
                <p class="title is-5">Interview Notes:</p>
                <small>{{ valueOrText($interview->notes) }}</small>
              </div>
            </div>
          </footer>

        </div>
    </div>
  </div>

@endsection
