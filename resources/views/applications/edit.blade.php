@extends('layouts.master')

@section('title', 'Edit Submission')

@section('hero')
  <hero-dashboard
    header="Edit Job Application"
    subheader="Make the desired changes to the form below to update your submitted job application.">
  </hero-dashboard>
@endsection

@section('content')

    <div class="columns">
      <div class="column is-8 is-offset-1 is_color6">

        <dashboard-title title="Edit Job Application"></dashboard-title>

          <section class="mgt_3">

            <form id="form" action="{{ route('applications.update', $application->id) }}" method="POST">
              {{ csrf_field() }}
              {{ method_field("PATCH") }}

              <!-- ICON -->
              <form-tooltip title="The Job can NOT be changed as this application is specifically associated with this job"></form-tooltip>

              <!-- JOB: -->
              <div class="field has-addons">
                <p class="control has-icon">
                  <input type="text" class="input is-large is-success" value="{{ $application->job->title }}" disabled >
                  <span class="icon"><i class="fa fa-briefcase size18" aria-hidden="true"></i></span>
                </p>
              </div>

              <!-- DATE APPLICATION WAS SUBMITTED -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Submitted on
                  </a>
                </p>
                <p class="control">
                  <input name="submitted_on" type="date" class="input is-large is-danger" value="{{ $application->submitted_on->toDateString() }}" required>
                </p>
              </div>

              <!-- RESUME: SELECT LIST -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Resume
                  </a>
                </p>
                <p class="control">
                  <span class="select is-large is-success">
                    <select name="resume_id" class="is-">
                      @foreach($resumes as $resume)
                        {{ $selected = ($application->resume_id == $resume->id)? ' selected' : '' }}
                        <option value="{{ $resume->id }}" {{$selected}}>{{ $resume->title }}</option>
                      @endforeach
                    </select>
                  </span>
                </p>
                &nbsp;<form-tooltip title="Select the resume used with your submitted application"></form-tooltip>
              </div>

              <!-- NOTES -->
              <div class="field">
                <p class="control">
                  <textarea name="notes" class="textarea">{{ $application->notes }}</textarea>
                </p>
              </div>

              @if($application->has_turned_down)
                <alert-nobtn msg="The application status is set to rejected and can not be changed" klass="is-warning"></alert-nobtn>
              @else
              <!-- CHECKBOX: has_submitted -->
              <div class="field">
                <p class="control">
                    <input name="has_submitted" type="checkbox" id="has_submitted" class="css3checkbox" {{ ($application->has_submitted)? ' checked' : '' }}>
                    <label for="has_submitted" class="toggler">Application submission is all complete</label>
                </p>
              </div>

              <!-- CHECKBOX: has_turned_down -->
              <div class="field">
                <p class="control">
                    <input name="has_turned_down" type="checkbox" id="has_turned_down" class="css3checkbox" {{ ($application->has_turned_down)? ' checked' : '' }}>
                    <label for="has_turned_down" class="toggler">Has your application been turned down</label>
                </p>
              </div>
              @endif

              <form-buttons url="/applications" button="Submit"></form-buttons>

              <input type="hidden" name="job_id" value="{{ $application->job_id }}">

            </form>
          </section>

          <form-footnote></form-footnote>
      </div>
    </div>

@endsection
