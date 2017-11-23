@extends('layouts.master')

@section('title', 'Job details')

@section('hero')
  <hero-dashboard
    header="List of all Jobs"
    subheader="The job view shows all job openings you created. After you submit your application with the employer for one of these jobs come back to this view and click [Add submittal details] button to create a record for the submitted application."
  >
  </hero-dashboard>
@endsection

@section('content')

  @if(jobs_indexed_by_employer())
    <a href="{{ url('jobs') }}" class="button is-link">View All Job Openings</a>
  @endif

<div class="section">

  <!-- //====================
      //== FILTERS
     //==================== -->
     @jobs_count
      <div class="columns mgb_1">
        <div class="column is-8 is-offset-1 pda_1">
          <nav class="level">
            <div class="left">        </div>

            <div class="level-right">
              <p class="level-item has-text-centered">
                <a href="/jobs" class="button {{ set_nav_active('') }}">Latest jobs</a>
              </p>
              <p class="level-item has-text-centered">
                <a href="/jobs?filter=all-active" class="button {{ set_nav_active('all-active') }}">All active jobs</a>
              </p>
              <p class="level-item has-text-centered">
                <a href="/jobs?filter=bookmarked" class="button {{ set_nav_active('bookmarked') }}">Bookmarked</a>
              </p>
              <p class="level-item has-text-centered">
                <a href="/jobs?filter=closed" class="button {{ set_nav_active('closed') }}">Closed</a>
              </p>
              <p class="level-item has-text-centered">
                <a href="/jobs?filter=not-submitted" class="button {{ set_nav_active('not-submitted') }}">Not submitted</a>
              </p>
            </div>
          </nav>
        </div>
      </div>
      @endjobs_count

  @forelse($jobs as $job)

    <div class="columns">
      <div class="column is-11">
          <article class="media">
            <div class="media-content">
              <div class="content">

                <!-- JOB TITLE / EMPLOYER -->
                <p class="title is-4">
                  <i class="fa fa-briefcase size18" aria-hidden="true"></i>
                  {{ $job->title }}
                  &nbsp;
                  <i class="fa fa-at size18"></i>
                  <a href="{{ route('employers.show', $job->employer->name )}}">
                    {{ $job->employer->name }}
                  </a>
                </p>

                <!-- JOB POSTER / DESCRIPTION -->
                <p class="subtitle is-6 mgl_1">
                  @if($job->posted_by)
                    <small><i class="fa fa-users" title="Posted by"></i> {{ $job->posted_by }}</small><br>
                  @endif
                  {{ \Illuminate\Support\Str::words($job->description, 30) }}
                </p>

                <!-- DETAILS LINE -->
                <div class="level notification">
                    <div class="level-item" >
                      <p class="heading">
                        <a title="Posted on 'where'">
                          <span class="icon">
                            <i class="fa fa-desktop size18" ></i>
                          </span>
                        </a>
                        @if(!empty($job->url))
                          <a href="{{ $job->url }}" class="is_link">{{ $job->venue->name }}</a>
                        @else
                          {{ $job->venue->name }}
                        @endif
                      </p>
                    </div>
                    <div class="level-item" >
                      <p class="heading">
                        <a title="Job was posted on 'date'">
                          <span class="icon">
                            <i class="fa fa-calendar-o size18" ></i>
                          </span>
                        </a>
                        {{ optional($job->date_posted)->toFormattedDateString() }}
                      </p>
                    </div>
                    <div class="level-item">
                      <p class="heading">
                        <a title="Job location">
                          <span class="icon">
                            <i class="fa fa-map-marker size18"></i>
                          </span>
                        </a>
                        {{ truncate_field($job->location) }}
                      </p>
                    </div>
                    <div class="level-item">
                      <p class="heading">
                        <a title="Job seniority level">
                          <span class="icon">
                            <i class="fa fa-location-arrow size18"></i>
                          </span>
                        </a>
                        {{ truncate_field($job->seniority_level) }}
                      </p>
                    </div>
                    <div class="level-item">
                      <p class="heading">
                        <a title="Compensation / Salary">
                          <span class="icon">
                            <i class="fa fa-money size18"></i>
                          </span>
                        </a>
                        {{ truncate_field($job->compensation) }}
                      </p>
                    </div>
                    <div class="level-item">
                      <p class="heading">
                        <a title="Employment Type">
                          <span class="icon">
                            <i class="fa fa-clock-o size18"></i>
                          </span>
                        </a>
                        {{ $job->employment_type->type }}
                      </p>
                    </div>
                </div>
              </div>
            </div>
            <!-- //====================
                //== RIGHT SECTION ICONS
               //==================== -->
            <div class="media-right">
              <nav class="level is-mobile">

                 <!-- BOOKMARKED? -->
                 <div class="level-item">
                     <a title="Bookmarked as important" class="is_notpointer">
                       <span class="icon">
                         <i class="fa fa-bookmark size24 {{ confirm_status($job->is_bookmarked) }}"></i>
                       </span>
                     </a>
                 </div>

                 <!-- SUBMITTED? -->
                 <div class="level-item">
                     <a title="An application has been submitted for this job" class="is_notpointer">
                       <span class="icon is-medium">
                         <i class="fa fa-external-link-square size24 {{ confirm_status($job->has_submitted) }}"></i>
                       </span>
                     </a>
                 </div>

                 <!-- UPDATED STATUS 'has_closed' TO TRUE -->
                 <div class="level-item">
                    @if($job->has_closed)
                       <a title="The status of this job opportunity was set to Closed" disabled>
                         <span class="icon is-medium">
                             <i class="fa fa-toggle-off size24 is_inactive"></i>
                     @else
                       <a href="{{ route('jobs.statusUpdate', $job->identifier) }}" title="Update the status of this job opportunity to Closed" >
                         <span class="icon is-medium">
                           <i class="fa fa-toggle-on size24"></i>
                     @endif
                         </span>
                       </a>
                 </div>

               </nav>

               <!-- BUTTON: SUBMIT APPLICATION -->
               <div class="has-text-centered">

                 @jobSubmittedNotClosed($job)
                   <a href="{{ route('applications.show', $job->identifier) }}" class="button is-info is-outlined is-small">
                     <span>View submittal details</span>
                   </a>
                 @endjobSubmittedNotClosed

                 @jobNotSubmittedNotClosed($job)
                   <a href="{{ route('applications.create', $job->identifier) }}" class="button is-primary is-outlined is-small">
                     <span>Add submittal details</span>
                   </a>
                 @endjobNotSubmittedNotClosed

                  @if($job->has_closed)
                    <a class="button is-static is-small">
                      <span>Job status is Closed</span>
                    </a>
                  @endif

               </div>
            </div>
          </article>
        <div class="seperator"></div>
      </div>

<!-- //====================
    //== ACTIONS:
   //==================== -->
      <div class="column">
        <nav class="level is-mobile">

          <!-- VIEW -->
          <div class="level-item">
            <div>
              <a href="{{ route('jobs.show', $job->identifier) }}" class="button is-info" title="View">
                <span class="icon is-small">
                  <i class="fa fa-map-o size24"></i>
                </span>
              </a>
            </div>
          </div>

          <!-- EDIT -->
          <div class="level-item">
            <div>
              <a href="{{ route('jobs.edit', $job->identifier) }}" class="button is-warning" title="Edit">
                <span class="icon is-small">
                  <i class="fa fa-pencil-square-o size24"></i>
                </span>
              </a>
            </div>
          </div>

          <!-- DELETE -->
          <div class="level-item">
            <div>
              <a href="{{ url('job/'.$job->identifier) }}" class="button is-danger" title="Delete?"
                onclick="event.preventDefault();
                document.getElementById('delete-{{$job->id}}').submit();"
              >
                <span class="icon is-small">
                  <i class="fa fa-trash-o size24"></i>
                </span>
              </a>
              <form id="delete-{{$job->id}}" action="{{ url('jobs/' . $job->identifier) }}" method="POST" class="is-hidden">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <input class="btn is-sm is-danger" type="submit" value="Delete">
               </form>
            </div>
          </div>

        </nav>
      </div>

    </div>

      @empty

        <alert-bulma msg="No jobs found (or jobs that meet the selected criteria)! To create a new record click " url={{ route('jobs.create') }} klass="is-warning"></alert-bulma>
  @endforelse

  @if(! jobs_indexed_by_employer() && $jobs->count())
    {{ $jobs->links() }}
  @endif

</div>
@endsection
