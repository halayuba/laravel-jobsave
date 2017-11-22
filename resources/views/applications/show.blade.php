@extends('layouts.master')

@section('title', 'Application details')

@section('hero')
  <hero-dashboard
    header="Application Details"
    subheader="Details of an application to a job opportunity"
  >
  </hero-dashboard>
@endsection

@section('content')
  <div class="columns">
    <div class="column is-half is-offset-2">
        <div class="card">
          <header class="card-header">

            <!-- JOB TITLE & EMPLOYER NAME -->
            <p class="card-header-title title is-4">
              <a href="{{ route('jobs.show', $job->identifier) }}">{{ $job->title}}</a>
               &nbsp;
              <i class="ion-more"></i> &nbsp;&nbsp;
              <a href="{{ route('employers.show', $job->employer->name) }}"> {{ $job->employer->name }}</a>
            </p>
          </header>

          <!-- DETAILS -->
          <div class="card-content">
            <div class="content">
              <card-content klass="ion-calendar" label="Submission Date" value="{{ $job->application->submitted_on->toFormattedDateString() }}"></card-content>
              <card-content klass="fa fa-file-text" label="Resume" value="{{ $job->application->resume->title }}"></card-content>
              <card-content klass="ion-android-contact" label="Submission" value="{{ ($job->application->has_submitted)? 'Complete' : 'Partial'}}"></card-content>
              <card-content klass="ion-forward" label="Application was turned down" value="{{ ($job->application->has_turned_down)? 'Yes' : 'No' }}"></card-content>
            </div>
          </div>

          <!-- APPLICATION NOTES -->
          @if($job->application->notes)
            <footer class="card-footer">
              <div class="pda_1">
                <div class="content">
                  <p class="title is-5">Notes:</p>
                  <small>{{ $job->application->notes }}</small>
                </div>
              </div>
            </footer>
          @endif

          <footer class="card-footer">
            <!-- EDIT ACTION -->
            <card-edit-button link="{{ route('applications.edit', $job->application->id) }}"></card-edit-button>

             <!-- DELETE ACTION -->
             @deleteApplication($job->application)
               <a href="{{ route('applications.destroy', $job->application->id) }}" class="card-footer-item"
                 onclick="event.preventDefault();
                 document.getElementById('delete-{{ $job->application->id }}').submit();"
                 title="Delete"
               >
                 <span class="icon is-small">
                   <i class="ion-trash-a size24"></i>
                 </span>
               </a>
             @else
               <card-delete-button title="Button is disabled because this job is associated with a submitted application!"></card-delete-button>
             @enddeleteApplication
          </footer>
        </div>
    </div>
  </div>

  <form id="delete-{{ $job->application->id }}" action="{{ route('applications.destroy', $job->application->id) }}" method="POST" class="is-hidden">
    {{csrf_field()}}
    {{method_field('DELETE')}}
    <input class="btn is-sm is-danger" type="submit" value="Delete">
  </form>

  <modal-view-image></modal-view-image>
  <div class="js_modal_backdrop"></div>

@endsection
