@extends('layouts.master')

@section('title', 'New Job')

@section('hero')
  <hero-dashboard
    header="Job Details"
    subheader="complete the form below to create a record for a new position you are goint to or have applied to">
  </hero-dashboard>
@endsection

@section('content')

    <div class="columns">
      <div class="column is-8 is-offset-1 is_color6">
        <dashboard-title title="Define New Job Oppurtunity"></dashboard-title>

          <section class="mgt_3">

            <form id="form" action="{{ url('/jobs') }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}

              <!-- NOTIFICATION ICON -->
              <form-tooltip title="Required fields are marked with green border"></form-tooltip>

              <!-- EMPLOYER -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Employer
                  </a>
                </p>
                <p class="control">
                  <span class="select is-large is-danger">
                    <select name="employer_id" class="is-danger">
                      @foreach($employers as $employer)
                        <option value="{{ $employer->id }}" {{ selected(old('employer_id'), $employer->id) }}>{{ $employer->name }}</option>
                      @endforeach
                    </select>
                  </span>
                </p>
                <p class="control mgl_1">
                  <a href="{{ route('employers.create') }}" title="If the list does not contain the employer for the job you're trying to define here then click this link to create a new employer">
                    <span class="icon">
                      <i class="ion-information-circled size24"></i>
                    </span> Not in the list? Add a new employer
                  </a>
                </p>
              </div>

              <!-- EMPLOYMENT TYPE -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Employment Type
                  </a>
                </p>
                <p class="control">
                  <span class="select is-large is-danger">
                    <select name="employment_type_id" class="">
                      @foreach($employment_types as $employment_type)
                        <option value="{{ $employment_type->id }}" {{ selected($employment_type->id, 1) }}>{{ $employment_type->type }}</option>
                      @endforeach
                    </select>
                  </span>
                </p>
              </div>

              <!-- WHERE DID YOU SEE THE POSTINGS -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Job posted on
                  </a>
                </p>
                <p class="control">
                  <span class="select is-large is-danger">
                    <select name="venue_id" required>
                      <option value="">Select</option>
                      @foreach($venues as $venue)
                        <option value="{{ $venue->id }}" {{ selected(old('venue_id'), $venue->id) }}>{{ $venue->name }}</option>
                      @endforeach
                    </select>
                  </span>
                </p>
              </div>

              <!-- URL -->
              <div class="field">
                <p class="control has-icon">
                  <input name="url" type="url" class="input is-large" value="{{ old('url') }}" placeholder="Link to job posting" >
                  <span class="icon">
                    <i class="ion-link"></i>
                  </span>
                </p>
              </div>

              <!-- JOB TITLE -->
              <div class="field">
                <p class="control">
                  <input name="title" type="text" class="input is-large is-danger" value="{{ old('title') }}" placeholder="Job title" required
                    @focusin="removeMsg"
                  >
                </p>
              </div>

              <!-- DESCRIPTION -->
              <div class="field">
                <p class="control">
                  <textarea name="description" class="textarea" placeholder="Job Description">{{ old('description') }}</textarea>
                </p>
              </div>

              <!-- LOCATION -->
              <div class="field">
                <p class="control">
                  <input name="location" type="text" class="input is-large is-danger" value="{{ old('location') }}" placeholder="Where is the location for this job" required>
                </p>
              </div>

              <!-- SENIORITY LEVEL -->
              <div class="field">
                <p class="control">
                  <input name="seniority_level" type="text" class="input is-large" value="{{ old('seniority_level') }}" placeholder="Seniority Level" >
                </p>
              </div>

              <!-- COMPENSATION -->
              <div class="field">
                <p class="control has-icon">
                  <input name="compensation" type="text" class="input is-large" value="{{ old('compensation') }}" placeholder="Compensation - this can include numbers and any additional details" >
                  <span class="icon">
                    <i class="ion-social-usd"></i>
                  </span>
                </p>
              </div>

              <!-- JOB POSTER -->
              <div class="field">
                <p class="control has-icon">
                  <input name="posted_by" type="text" class="input is-large" value="{{ old('posted_by') }}" placeholder="(if known) employee who posted this job?">
                  <span class="icon">
                    <i class="ion-ios-people"></i>
                  </span>
                </p>
              </div>

              <!-- DATE JOB POSTED -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Posted on
                  </a>
                </p>
                <p class="control">
                  <input name="date_posted" type="date" class="input is-large" value="{{ old('date_posted')?: date('Y-m-d') }}">
                </p>
                <form-tooltip title="If the date this job was posted on is unknown to you then you can refer to this as the date you knew about this job opening"></form-tooltip>
              </div>

              <!-- FILE UPLOAD FOR THE JOB DESCRIPTION -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Upload &nbsp;
                  </a>
                </p>
                <p class="control">
                  <input name="file" type="file" class="input is-large" value="{{ old('file') }}">
                </p>
                <form-tooltip title="Upload a PDF file or a screenshot image of the job description if desired"></form-tooltip>
              </div>

              <!-- CHECKBOX >> 'is_bookmarked' -->
              <form-checkbox text="Mark this job as important (if eagerly pursuing)"></form-checkbox>

              <!-- FORM BUTTONS -->
              <form-buttons url="/jobs" button="Submit"></form-buttons>

            </form>
          </section>

          <form-footnote></form-footnote>

      </div>
    </div>

@endsection
