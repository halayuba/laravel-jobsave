@extends('layouts.master')

@section('title', 'Job Interviews')

@section('hero')
  <hero-dashboard
    header="List of interviews you've already completed"
    subheader='This view displays successfull interviews with potential offers. To create a record for an offer select one of the interviews in the list to open a form then complete and submit.'
  >
  </hero-dashboard>
@endsection

@section('content')

  @if(count($interviews))
    <div class="columns is-multiline">
      @foreach($interviews as $interview)
        <div class="column is-one-third">

          <div class="card">
            <header class="card-header">

              <!-- JOB TITLE & EMPLOYER NAME -->
              <p class="card-header-title title is-4">
                <a href="{{ route('jobs.show', $interview->job->identifier) }}">{{ $interview->job->title }} </a>
                &nbsp;
                <i class="ion-more"></i> &nbsp;&nbsp;
                <a href="{{ route('employers.show', $interview->job->employer->name) }}"> {{ $interview->job->employer->name }}</a>
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
                <card-content klass="icon-presentation" label="Type of the Interview" value="{{ $interview->interview_type->type }}"></card-content>
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

            <footer class="card-footer">
              <a href="{{ route('offers.create', $interview->job->identifier) }}" class="button is-primary card-footer-item">
                <span class="icon">
                  <i class="ion-toggle-filled size24"></i>
                </span> &nbsp; &nbsp; Enter job offer
              </a>
            </footer>

          </div>

        </div>
      @endforeach
    </div>
  @else
    <alert-bulma msg="The system does not currently have any documented successfull interviews that you can begin to associate an offer to! Start " url="/interviews" klass="is-warning"></alert-bulma>
  @endif

@endsection
