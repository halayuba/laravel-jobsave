@extends('layouts.master')

@section('title', 'New Submission')

@section('hero')
  <hero-dashboard
    header="Job Application"
    subheader="Complete the form below to create a new record for your submitted job application.">
  </hero-dashboard>
@endsection

@section('content')

    <div class="columns">
      <div class="column is-8 is-offset-1 is_color6">

        <!-- //====================
          //== SHOW SUMMARY INFO ABOUT THE JOB UNDER CONSIDERATION
        //==================== -->
        <div class="notification is-info">
          [This is in reference to job ({{ $job->title }}) with employer ({{ $job->employer->name }})]. Use this form to provide details about an application you've submitted for this job so that you can keep a record about your application submittal.
        </div>

        <dashboard-title title="Job Application"></dashboard-title>

          <section class="mgt_3">

            <form id="form" action="{{ route('applications.store', $job->identifier) }}" method="post">
              {{csrf_field()}}

              <!-- ICON -->
              <form-tooltip title="Required fields are marked with red border"></form-tooltip>

              <!-- DATE APPLICATION WAS SUBMITTED -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Submitted on
                  </a>
                </p>
                <p class="control">
                  <input name="submitted_on" type="date" class="input is-large is-danger" value="{{ date('Y-m-d') }}" required>
                </p>&nbsp;
                <form-tooltip title="A future date can not be accepted!"></form-tooltip>
              </div>

              <!-- RESUME: SELECT LIST -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Resume
                  </a>
                </p>
                <p class="control">
                  <span class="select is-large is-danger">
                    <select name="resume_id" required>
                      @foreach($resumes as $resume)
                        <option value="{{ $resume->id }}" {{ selected(old('resume_id'), $resume->id ) }}>{{ $resume->title }}</option>
                      @endforeach
                    </select>
                  </span>
                </p>
                @resumeExists
                  &nbsp;<form-tooltip title="Select the resume used with your submitted application"></form-tooltip>
                @endresumeExists
                  <p class="control">
                    <a href="{{ route('resumes.create') }}" class="css_a" title="If the list does not contain the resume that you've used at the time you submitted your application then click here to create new ...">
                      &nbsp; Not in the list? Add new resume
                    </a>
                  </p>
              </div>

              <!-- NOTES -->
              <div class="field">
                <p class="control">
                  <textarea name="notes" class="textarea" placeholder="Notes">{{ old('notes') }}</textarea>
                </p>
              </div>

              <!-- CHECKBOX: has_submitted -->
              <div class="field has-addons">
                <p class="control">
                    <input name="has_submitted" type="checkbox" id="has_submitted" class="css3checkbox" checked>
                    <label for="has_submitted" class="toggler">Application submission is all complete</label>
                </p>&nbsp;
                <form-tooltip title="Uncheck if only partial submission"></form-tooltip>
              </div>

              <!-- CHECKBOX: has_turned_down -->
              <div class="field has-addons">
                <p class="control">
                    <input name="checkbox" type="checkbox" id="checkbox" class="css3checkbox">
                    <label for="checkbox" class="toggler">Has your application been turned down</label>
                </p>&nbsp;
                <form-tooltip title="Once an application is rejected the status can not be reveresed"></form-tooltip>
              </div>

              <form-buttons url="/applications" button="Submit"></form-buttons>

            </form>
          </section>

          <form-footnote></form-footnote>
      </div>
    </div>

@endsection
