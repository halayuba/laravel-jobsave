@extends('layouts.master')

@section('title', 'New Interview')

@section('hero')
  <hero-dashboard
    header="Job Interview"
    subheader="Complete the form below to create a new record for a job interview.">
  </hero-dashboard>
@endsection

@section('content')

    <div class="columns">
      <div class="column is-8 is-offset-1 is_color6">

        <!-- //====================
          //== SHOW SUMMARY INFO ABOUT THE JOB UNDER CONSIDERATION
        //==================== -->
        <div class="notification is-info">
          [This is in reference to job ({{ $job->title }}) with employer ({{ $job->employer->name }})]. Use this form to provide details about your upcoming interview for this job opportunity so that you can keep a record about important information.
        </div>

        <dashboard-title title="Job Interview"></dashboard-title>

          <section class="mgt_3">

            <form id="form" action="{{ route('interviews.store', $job->identifier) }}" method="post">
              {{csrf_field()}}

              <!-- NOTIFICATION ICON -->
              <form-tooltip title="Required fields are marked with red border"></form-tooltip>

              <!-- DATE OF INTERVIEW -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Interview date
                  </a>
                </p>
                <p class="control">
                  <input name="date" type="date" class="input is-large is-danger" value="{{ old('date')?: date('Y-m-d') }}" required>
                </p>
                &nbsp;<form-tooltip title="Must be within +/- 30 days"></form-tooltip>
              </div>

              <!-- TIME OF INTERVIEW -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Interview time
                  </a>
                </p>
                <p class="control">
                  <input name="time" type="time" class="input is-large is-danger" value="{{ old('time')?: date('h:i A') }}" required>
                </p>
                &nbsp;<form-tooltip title="Enter in your local time zone"></form-tooltip>
              </div>

              <!-- INTERVIEW TYPE: SELECT LIST -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Interview type
                  </a>
                </p>
                <p class="control">
                  <span class="select is-large is-danger">
                    <select name="interview_type_id">
                      @foreach($interview_types as $interview_type)
                        <option value="{{ $interview_type->id }}" {{ selected(old('interview_type_id'), $interview_type->id ) }}>{{ $interview_type->type }}</option>
                      @endforeach
                    </select>
                  </span>
                </p>
                &nbsp;<form-tooltip title="Select how is the interview being setup"></form-tooltip>
              </div>

              <!-- INTERVIEWER -->
              <div class="field">
                <p class="control has-icon">
                  <input name="interviewer" type="text" class="input is-large" value="{{ old('interviewer') }}" placeholder="If more than one interviewer then use comma to separate names">
                  <span class="icon">
                    <i class="ion-ios-people"></i>
                  </span>
                </p>
              </div>

              <!-- NOTES -->
              <div class="field">
                <p class="control">
                  <textarea name="notes" class="textarea" placeholder="Notes">{{ old('notes') }}</textarea>
                </p>
              </div>

              <!-- CHECKBOX: is_cancelled -->
              <div class="field">
                <p class="control">
                    <input name="is_canceled" type="checkbox" id="is_canceled" class="css3checkbox" >
                    <label for="is_canceled" class="toggler">Interview has been canceled</label>
                </p>
              </div>

              <form-buttons button="Submit" url="/interviews"></form-buttons>

            </form>
          </section>

          <form-footnote></form-footnote>
      </div>
    </div>

@endsection
