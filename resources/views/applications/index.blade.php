@extends('layouts.master')

@section('title', 'Applications')

@section('hero')
  <hero-dashboard
    header="Job Applications"
    subheader="This view shows your list of application submissions in response to job postings.">
  </hero-dashboard>
@endsection

@section('content')

<div class="section">

  <!-- //====================
      //== FILTERS
     //==================== -->
     @applications_count
      <div class="columns mgb_1">
        <div class="column is-8 is-offset-1 pda_1">
          <nav class="level">
            <div class="left">        </div>

            <div class="level-right">
              <p class="level-item has-text-centered">
                <a href="/applications?filter=current" class="button {{ set_nav_active('current') }}">Current Applications (during the past 30 days)</a>
              </p>
              <p class="level-item has-text-centered">
                <a href="/applications?filter=past" class="button {{ set_nav_active('past') }}">Old Applications</a>
              </p>
              <p class="level-item has-text-centered">
                <a href="/applications?filter=rejected" class="button {{ set_nav_active('rejected') }}">Rejected Applications</a>
              </p>
            </div>
          </nav>
        </div>
      </div>
      @endapplications_count

  @if(count($jobs))
    <div class="columns">
      <div class="column is-10">

        <!-- //====================
            //== TABLE SHOWING A LIST OF ALL CATEGORIES
           //==================== -->
        <div class="content">
          <table class="table">
            <thead>
              <tr>
                <th>Employer / Job</th>
                <th>Resume</th>
                <th>Submission Date</th>
                <th>Submission?
                    <a title="Partial or Complete Submission?">
                      <span class="icon">
                        <i class="ion-information-circled size18"></i>
                      </span>
                    </a>
                </th>
                <th>Response?</th>
                <th class="is-pulled-right">Perform Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($jobs as $job)
                <tr class="{{ $job->has_turned_down? 'notification' : '' }}">
            <!-- //====================
                //== TABLE FIELDS
               //==================== -->
                  <th>
                    <a href="{{ route('employers.show', $job->Employer) }}">{{ $job->Employer }}</a> / <a href="{{ route('jobs.show', $job->JobID) }}">{{ $job->Job }}</a>
                  </th>
                  <th>
                    <span class="tblCell_font_small">{{ $job->Resume }}</span>
                  </th>
                  <th>
                    <span class="tblCell_font_small">{{ formatDateTime($job->submitted_on, 'M j, Y') }}</span>
                  </th>
                  <th>
                    <span class="tblCell_font_small">{{ submission($job->has_submitted) }}</span>
                  </th>
                  <th>
                    <span class="tblCell_font_small">{{ rejection($job->has_turned_down) }}</span>
                  </th>
                  <th class="is-pulled-right">

              <!-- //====================
                  //== VIEW NOTES: ACTION
                 //==================== -->
                   <a data-href="/applications/modal" id="{{ $job->AppID }}" class="button is-success is-small openModal" title="View notes" {{ disbabled_button(! $job->notes) }} >
                     <span class="icon is-small">
                       <i class="fa fa-file-word-o" aria-hidden="true"></i>
                     </span>
                   </a>

              <!-- //====================
                  //== GO TO INTERVIEW FORM: ACTION
                 //==================== -->
                     @interviewBtn($job->has_closed, $job->has_turned_down, $job->job_id)
                       <a href="{{ route('interviews.create', $job->JobID) }}" class="button is-primary is-small" title="Do you have an interview to record details about?"
                         v-if="interviewCreate"
                       >
                         <span class="icon">
                           <i class="fa fa-check-circle size24"></i>
                         </span>
                       </a>
                     @else
                       <a class="button is-primary is-small" title="Button is disabled because you either have an upcoming interview setup already in the system or your job application has a status of rejected." disabled >
                         <span class="icon">
                           <i class="fa fa-check-circle size24"></i>
                         </span>
                       </a>
                     @endinterviewBtn

              <!-- //====================
                  //== UPDATE STATUS TO REJECTED
                 //==================== -->
                     @if($job->has_turned_down)
                       <a class="button is-small is_color3_d" title="The status of this job application is set to Rejected" disabled >
                         <span class="icon is-small">
                           <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                         </span>
                       </a>
                     @else
                       <a href="{{ route('applications.statusUpdate', $job->AppID) }}" class="button is-small is_color12" title="Update the status of this job application to Rejected"
                         @click="interviewCreate=false"
                         >
                         <span class="icon is-small">
                           <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                         </span>
                       </a>
                     @endif

              <!-- //====================
                  //== EDIT ACTION
                 //==================== -->
                    <a href="{{ route('applications.edit', $job->AppID) }}" class="button is-warning is-small" title="Edit job application" >
                      <span class="icon is-small">
                        <i class="fa fa-pencil-square-o size24"></i>
                      </span>
                    </a>

              <!-- //====================
                  //== DELETE ACTION
                 //==================== -->
                    <a href="{{ route('applications.destroy', $job->AppID) }}" class="button is-danger is-small" title="Delete job application"
                      onclick="event.preventDefault();
                      document.getElementById('delete-{{ $job->AppID }}').submit();"
                    >
                      <span class="icon is-small">
                        <i class="fa fa-trash-o size24"></i>
                      </span>
                    </a>
                    <form id="delete-{{ $job->AppID }}" action="{{ route('applications.destroy', $job->AppID) }}" method="POST" class="is-hidden">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                      <input class="btn is-sm is-danger" type="submit" value="Delete">
                    </form>
                  </th>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>
  @else
    <alert-bulma msg="No application submissions found! To create a new record click " url="{{ url('applications/job-openings') }}" klass="is-warning"></alert-bulma>
  @endif

</div>

  <modal-view header="Application Notes"></modal-view>
  <div class="js_modal_backdrop"></div>

@endsection
