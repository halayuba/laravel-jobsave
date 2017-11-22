@extends('layouts.master')

@section('title', 'Edit Interview')

@section('hero')
  <hero-dashboard
    header="Edit Interview appointment"
    subheader="Use the form below to update a job interview appointment">
  </hero-dashboard>
@endsection

@section('content')

    <div class="columns">
      <div class="column is-8 is-offset-1 is_color6">

        <dashboard-title title="Job Interview Appointment"></dashboard-title>

          <section class="mgt_3">

            <form id="form" action="{{ route('interviews.update', $interview->id) }}" method="post">
              {{ csrf_field() }}
              {{ method_field("PATCH") }}

              <!-- NOTIFICATION ICON -->
              <form-tooltip title="Required fields are marked with red border"></form-tooltip>

              <!-- DATE OF INTERVIEW -->
              @if($interview->is_canceled)
                <disabled-field label="Interview date" value="{{ $interview->date->toDateString() }}"></disabled-field>
              @else
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Interview date
                  </a>
                </p>
                <p class="control">
                  <input name="date" type="date" class="input is-large is-danger" value="{{ $interview->date->toDateString() }}" required>
                </p>
                &nbsp;<form-tooltip title="Must be within +/- 30 days"></form-tooltip>
              </div>
              @endif

              <!-- TIME OF INTERVIEW -->
              @if($interview->is_canceled)
                <disabled-field label="Interview time" value="{{ formatDateTime($interview->time, 'g:i a') }}"></disabled-field>
              @else
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Interview time
                  </a>
                </p>
                <p class="control">
                  <input name="time" type="time" class="input is-large is-danger" value="{{ $interview->time }}" required>
                </p>
                &nbsp;<form-tooltip title="Enter a value in your local time zone"></form-tooltip>
              </div>
              @endif

              <!-- INTERVIEW TYPE: SELECT LIST -->
              @if($interview->is_canceled)
                <disabled-field label="Interview type" value="{{ $interview->interview_type->type }}"></disabled-field>
              @else
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Interview type
                  </a>
                </p>
                <p class="control">
                  <span class="select is-large is-success">
                    <select name="interview_type_id">
                      @foreach($interview_types as $interview_type)
                        {{ $selected = ( $interview->interview_type_id == $interview_type->id)? ' selected': '' }}
                        <option value="{{ $interview_type->id }}" {{$selected}}>{{ $interview_type->type }}</option>
                      @endforeach
                    </select>
                  </span>
                </p>
                &nbsp;<form-tooltip title="Select how the interview is being setup"></form-tooltip>
              </div>
              @endif

              <!-- INTERVIEWER -->
              <div class="field">
                <p class="control has-icon">
                  <input name="interviewer" type="text" class="input is-large" placeholder="If more than one interviewer then use comma to separate names" value="{{ $interview->interviewer }}">
                  <span class="icon">
                    <i class="ion-ios-people"></i>
                  </span>
                </p>
              </div>

              <!-- NOTES -->
              <div class="field">
                <p class="control">
                  <textarea name="notes" class="textarea" placeholder="Notes">{{ $interview->notes }}</textarea>
                </p>
              </div>

              <!-- CHECKBOX: is_cancelled -->
              @if($interview->is_canceled)
                <alert-nobtn msg="The status of this interview is set to canceled so the interview date, time, and type can not be changed!" klass="is-warning"></alert-nobtn>
              @else
              <div class="field">
                <p class="control">
                    <input name="is_canceled" type="checkbox" id="is_canceled" class="css3checkbox" {{ $interview->is_canceled? ' checked' : '' }}>
                    <label for="is_canceled" class="toggler">Interview has been canceled</label>
                </p>
              </div>
              @endif

              <input type="hidden" name="job_id" value="{{ $interview->job_id }}">

              <form-buttons button="Submit" url="/interviews"></form-buttons>

            </form>
          </section>

          <form-footnote></form-footnote>
      </div>
    </div>

@endsection
