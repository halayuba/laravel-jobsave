@extends('layouts.master')

@section('title', 'Job details')

@section('hero')
  <hero-dashboard
    header="Job Details"
    subheader="Details of a job opportunity"
  >
  </hero-dashboard>
@endsection

@section('content')
  <div class="columns">
    <div class="column is-half is-offset-2">
        <div class="card">
          <header class="card-header">
            <p class="card-header-title title is-4">{{ $job->title}} &nbsp;
              <i class="fa fa-ellipsis-h"></i> &nbsp;&nbsp;
              <a href="{{ route('employers.show', $job->employer->name) }}"> {{ $job->employer->name }}</a>

              @if($job->has_closed)
              &nbsp; &nbsp;<span class="tag is-danger"><strong>Closed</strong></span>
              @endif
              @jobSubmittedNotClosed($job)
                &nbsp; &nbsp;<span class="tag is-success"><strong>Applied to</strong></span>
              @endjobSubmittedNotClosed

            </p>
          </header>
          <div class="card-content">
            <div class="content">
              <card-content klass="fa fa-map-marker" label="Job Location" value="{{ $job->location }}"></card-content>
              <card-content klass="fa fa-clock-o" label="Employment Type" value="{{ $job->employment_type->type }}"></card-content>
              <card-content klass="fa fa-money" label="Compensation" value="{{ $job->compensation }}"></card-content>
              <card-content klass="fa fa-paper-plane" label="Seniority Level" value="{{ $job->seniority_level }}"></card-content>
              <card-content klass="fa fa-calendar " label="Date Posted or Noticed" value="{{ $job->date_posted->toFormattedDateString() }}"></card-content>

              <!-- JOB URL & VENUE -->
                @if(!empty($job->url))
                  <p>
                    <span class="tag is-light">
                      <span class="icon">
                        <i class="fa fa-desktop size18"></i>
                      </span>
                      <small>Venue:</small>
                    </span>
                    <a href="{{ $job->url }}">{{ $job->venue->name }}</a>
                  </p>
                @else
                  <card-content klass="fa fa-desktop" label="Venue" value="{{ $job->venue->name }}"></card-content>
                @endif

              <card-content klass="fa fa-female" label="Job Poster" value="{{ ($job->posted_by)? $job->posted_by : 'Not available'}}"></card-content>
              <card-content klass="fa fa-bookmark" label="Bookmarked" value="{{ ($job->is_bookmarked)? 'Yes' : 'No' }}"></card-content>
              <card-content klass="fa fa-share" label="Application Submitted" value="{{ ($job->has_submitted)? 'Yes' : 'No' }}"></card-content>
              <card-content klass="fa fa-window-close-o" label="Job Closed" value="{{ ($job->has_closed)? 'Yes' : 'No' }}"></card-content>
              <card-content klass="fa fa-picture-o" label="File upload" value="{{ $filename }}"></card-content>

              <!-- //====================
                  //== EITHER SHOW IMAGE MODAL OR PERFORM DOWNLOAD DEPENDING ON TYPE OF IMAGE
                 //==================== -->
             <!-- SHOW IMAGE MODAL -->
             @image($image)
               <a href="#" class="button is-primary is-outlined openImageModal" data-image="{{ $image['name'] }}" data-width="{{ $image['width'] }}" data-height="{{ $image['height'] }}" >
                 <span class="icon"><i class="fa fa-map"></i></span>&nbsp;
                 View
               </a>
             @endimage

             <!-- DOWNLOAD PDF / DOC -->
             @download($image)
               <a href="{{ route('jobs.download', $job->identifier) }}" class="button is-primary is-outlined" >
                 <span class="icon"><i class="fa fa-download"></i></span>&nbsp;
                 Download
               </a>
             @enddownload

            </div>
          </div>

          @if($job->description)
            <footer class="card-footer">
              <div class="pda_1">
                <div class="content">
                  <p class="title is-5">Job description:</p>
                  <small>{{ $job->description }}</small>
                </div>
              </div>
            </footer>
          @endif

          <footer class="card-footer">

            <!-- EDIT ACTION -->
            <card-edit-button link="{{ route('jobs.edit', $job->identifier) }}"></card-edit-button>

             <!-- DELETE ACTION -->
             @deleteButton($job)
               <a href="{{ route('jobs.destroy', $job->identifier) }}" class="card-footer-item"
                 onclick="event.preventDefault();
                 document.getElementById('delete-{{ $job->id }}').submit();"
                 title="Delete"
               >
                 <span class="icon is-small">
                   <i class="fa fa-trash-o size24"></i>
                 </span>
               </a>
             @else
               <card-delete-button title="Button is disabled because this job is associated with a submitted application!"></card-delete-button>
             @enddeleteButton
          </footer>
        </div>
    </div>
  </div>

  <form id="delete-{{ $job->id }}" action="{{ route('jobs.destroy', $job->identifier) }}" method="POST" class="is-hidden">
    {{csrf_field()}}
    {{method_field('DELETE')}}
    <input class="btn is-sm is-danger" type="submit" value="Delete">
  </form>

  <modal-view-image></modal-view-image>
  <div class="js_modal_backdrop"></div>

@endsection
