@extends('layouts.master')

@section('title', 'Edit Job')

@section('hero')
  <hero-dashboard
    header="Edit Job Details"
    subheader="Make the desired changes to the form below to update this record">
  </hero-dashboard>
@endsection

@section('content')

    <div class="columns">
      <div class="column is-8 is-offset-1 is_color6">
        <dashboard-title title="Update Job Oppurtunity"></dashboard-title>

          <section class="mgt_3">

            <form id="form" action="{{ route('jobs.update', $job->identifier) }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              {{ method_field("PATCH") }}

              <!-- ICON -->
              <form-tooltip title="Required fields are marked with red border"></form-tooltip>

              <!-- EMPLOYER -->
                <!-- MUST NOT ALLOW THE EMPLOYER FIELD TO BE CHANGED FOR JOBS WITH A SUBMITTED APPLICATION  -->
                @jobSubmittedClosed($job)
                  <div class="field">
                    <p class="control has-icon">
                      <input type="text" class="input is-large is-success" value="{{ $job->employer->name }}" disabled>
                      <span class="icon">
                        <i class="fa fa-building size18"></i>
                      </span>
                    </p>
                  </div>
                @else
                  <div class="field has-addons">
                    <p class="control">
                      <a class="button is-static is-large">
                        Employer
                      </a>
                    </p>
                    <p class="control">
                      <span class="select is-large is-success">
                        <select name="employer_id" class="is-success">
                          @foreach($employers as $employer)
                          <option value="{{ $employer->id }}" {{ selected(old('employer_id'), $employer->id, $job->employer_id) }}>{{ $employer->name }}</option>
                          @endforeach
                        </select>
                      </span>
                    </p>
                  </div>
                @endif

              <!-- EMPLOYMENT TYPE -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Employment Type
                  </a>
                </p>
                <p class="control">
                  <span class="select is-large is-success">
                    <select name="employment_type_id" class="">
                      @foreach($employment_types as $employment_type)
                        <option value="{{ $employment_type->id }}" {{ selected(old('employment_type_id'), $employment_type->id, $job->employment_type_id) }}>{{ $employment_type->type }}</option>
                      @endforeach
                    </select>
                  </span>
                </p>
              </div>

              <!-- WHERE DID YOU SEE THIS POSTINGS -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Job posted on
                  </a>
                </p>
                <p class="control">
                  <span class="select is-large is-success">
                    <select name="venue_id" class="">
                      @foreach($venues as $venue)
                        <option value="{{ $venue->id }}" {{ selected(old('venue_id'), $venue->id, $job->venue_id) }}>{{ $venue->name }}</option>
                      @endforeach
                    </select>
                  </span>
                </p>
              </div>

              <!-- URL -->
              <div class="field">
                <p class="control has-icon">
                  <input name="url" type="url" class="input is-large" value="{{ old('url')?: $job->url }}" placeholder="Link to job posting" >
                  <span class="icon">
                    <i class="ion-link"></i>
                  </span>
                </p>
              </div>

              <!-- JOB TITLE -->
              <div class="field">
                <p class="control">
                  <input name="title" type="text" class="input is-large is-danger" value="{{ old('title')?: $job->title }}" placeholder="Job title" required
                    @focusin="removeMsg"
                  >
                </p>
              </div>

              <!-- DESCRIPTION -->
              <div class="field">
                <p class="control">
                  <textarea name="description" class="textarea" placeholder="Description">{{ old('description')?: $job->description }}</textarea>
                </p>
              </div>

              <!-- LOCATION -->
              <div class="field">
                <p class="control">
                  <input name="location" type="text" class="input is-large is-danger" value="{{ old('location')?: $job->location }}" placeholder="Where is the location for this job" required >
                </p>
              </div>

              <!-- SENIORITY LEVE -->
              <div class="field">
                <p class="control">
                  <input name="seniority_level" type="text" class="input is-large" value="{{ old('seniority_level')?: $job->seniority_level }}" placeholder="Seniority Level" >
                </p>
              </div>

              <!-- COMPENSATION -->
              <div class="field">
                <p class="control has-icon">
                  <input name="compensation" type="text" class="input is-large" value="{{ old('compensation')?: $job->compensation }}" placeholder="Compensation" >
                  <span class="icon">
                    <i class="ion-social-usd"></i>
                  </span>
                </p>
              </div>

              <!-- JOB POSTER -->
              <div class="field">
                <p class="control has-icon">
                  <input name="posted_by" type="text" class="input is-large" value="{{ old('posted_by')?: $job->posted_by }}" placeholder="Job Posted by">
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
                  <input name="date_posted" type="date" class="input is-large" value="{{ old('date_posted')?: optional($job->date_posted)->toDateString() }}">
                </p>
                <p class="control">
                  <a title="If the date this job was posted on is unknown to you then you can refer to this as the date you found out about this job opening">
                    <span class="icon">
                      <i class="ion-information-circled size24"></i>
                    </span>
                  </a>
                </p>
              </div>

              <!-- FILE UPLOAD FOR THE JOB DESCRIPTION -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Upload &nbsp;
                  </a>
                </p>
                <p class="control">
                  <input name="file" type="file" class="input is-large">
                </p>
                <form-tooltip title="Upload a PDF file or a screenshot image of the job description if desired"></form-tooltip>
                <p class="control">
                  <span class="is_color2 mgl_1">{{ str_after($job->file, 'public/jobs/') }}</span>
                </p>
              </div>

              <!-- CHECKBOX >> 'is_bookmarked' -->
              <div class="field">
                <p class="control">
                    <input name="checkbox" type="checkbox" id="checkbox" class="css3checkbox" {{ ($job->is_bookmarked)? ' checked' : '' }}>
                    <label for="checkbox" class="toggler">Mark this job as important (if eagerly pursuing)</label>
                </p>
              </div>
              <!-- CHECKBOX >> 'has_closed' -->
              <div class="field">
                <p class="control">
                    <input name="has_closed" type="checkbox" id="has_closed" class="css3checkbox" {{ ($job->has_closed)? ' checked' : '' }}>
                    <label for="has_closed" class="toggler">Has this job opportunity closed?</label>
                </p>
              </div>

              <!-- FORM BUTTONS -->
              <form-buttons url="/jobs" button="Submit"></form-buttons>

            </form>
          </section>

          <form-footnote></form-footnote>

      </div>
    </div>

@endsection
