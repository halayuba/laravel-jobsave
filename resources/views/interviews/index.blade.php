@extends('layouts.master')

@section('title', 'Interviews')

@section('hero')
  <hero-dashboard
    header="List of all Interviews"
    subheader="This view shows your interviews. You can update or delete interviews, or add a new interview from the [Create Content] list above"
  >
  </hero-dashboard>
@endsection

@section('content')

<div class="section">

    <!-- //====================
        //== FILTERS
       //==================== -->
       @interviews_count
        <div class="columns mgb_1">
          <div class="column is-8 is-offset-1 pda_1">
            <nav class="level">
              <div class="left">        </div>

              <div class="level-right">
                <p class="level-item has-text-centered">
                  <a href="/interviews" class="button {{ set_nav_active('') }}">All Interviews</a>
                </p>
                <p class="level-item has-text-centered">
                  <a href="/interviews?filter=upcoming" class="button {{ set_nav_active('upcoming') }}">Upcoming Interviews</a>
                </p>
                <p class="level-item has-text-centered">
                  <a href="/interviews?filter=past" class="button {{ set_nav_active('past') }}">Past Interviews</a>
                </p>
                <p class="level-item has-text-centered">
                  <a href="/interviews?filter=canceled" class="button {{ set_nav_active('canceled') }}">Canceled Interviews</a>
                </p>
              </div>
            </nav>
          </div>
        </div>
        @endinterviews_count

  @forelse($interviews as $interview)

    <div class="columns">
      <div class="column is-10">
          <article class="media">
            <div class="media-content">
              <div class="content">

                <!-- EMPLOYER NAME / JOB TITLE -->
                <p class="title is-4">
                  <i class="fa fa-at size18" aria-hidden="true"></i>
                  <a href="{{ route('employers.show', $interview->job->employer->name )}}">
                    {{ $interview->job->employer->name }}
                  </a>
                  &nbsp;
                  <i class="fa fa-briefcase size18" aria-hidden="true"></i>
                  <a href="{{ route('jobs.show', $interview->job->identifier) }}">
                    {{ $interview->job->title }}
                  </a>
               </p>

              <!-- NOTES -->
              <p class="subtitle is-6">{{ $interview->notes }}</p>

              <div class="level notification">
                <!-- INTERVIEWERS -->
                <div class="level-item">
                  <p class="heading">
                    <i class="fa fa-user-secret size18" title="Interviewer(s)"></i>
                    {{ $interview->interviewer }}
                  </p>
                </div>
                <!-- INTERVIEW TYPE -->
                <div class="level-item">
                  <p class="heading">
                    <i class="fa fa-comments size18" title="Type of Interview?"></i>
                    {{ $interview->interview_type->type }}
                  </p>
                </div>
                <!-- INTERVIEW DATE -->
                <div class="level-item">
                  <p class="heading">
                    <i class="fa fa-calendar-check-o size18" title="Date and Time of Interview"></i>
                    {{ optional($interview->date)->toFormattedDateString() .' @'. formatDateTime($interview->time, 'g:i a') }}
                  </p>
                </div>
                <!-- INTERVIEW STATUS -->
                  @if($interview->is_canceled)
                    <div class="level-item">
                      <span class="tag is-danger"><strong>Canceled</strong></span>
                    </div>
                  @elseif($interview->is_unsuccessful)
                    <div class="level-item">
                      <span class="tag is-danger"><strong>Unsuccessful</strong></span>
                    </div>
                  @endif
              </div>
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

          <!-- OFFER -->
          @offers($interview)
          <div class="level-item">
            <div>
              <a href="{{ route('offers.create', $interview->job->identifier) }}" class="button is-success" title="Offer received? create a new offer">
                <span class="icon is-small">
                  <i class="fa fa-bullseye size24" aria-hidden="true"></i>
                </span>
              </a>
            </div>
          </div>
          @endoffers

          <!-- EDIT -->
          <div class="level-item">
            <div>
              <a href="{{ route('interviews.edit', $interview->id) }}" class="button is-warning" title="Edit">
                <span class="icon is-small">
                  <i class="fa fa-pencil-square-o size24"></i>
                </span>
              </a>
            </div>
          </div>

         <!-- UPDATE STATUS TO CANCELED -->
         <div class="level-item">
           <div>
          @btnCanceled($interview)
            <a href="{{ route('interviews.statusUpdateCanceled', $interview->id) }}" class="button is-info" title="Update the status of this interview to Canceled">
              <span class="icon is-small">
                <i class="fa fa-calendar-times-o" aria-hidden="true" size24></i>
              </span>
            </a>
          @else
            <a class="button is-info" title="Disabled because this interview has occurred already in the past and therefore can not be canceled anymore or the status of this interview is set to either unsuccessful or canceled" disabled>
              <span class="icon is-small">
                <i class="fa fa-calendar-times-o" aria-hidden="true" size24></i>
              </span>
            </a>
          @endbtnCanceled
          </div>
        </div>

          <!-- UPDATE STATUS TO UNSUCCESSFUL INTERVIEW -->
          <div class="level-item">
           <div>
           @btnUnsuccessful($interview)
             <a href="{{ route('interviews.statusUpdateUnsuccessful', $interview->id) }}" class="button is_color12" title="Update the status of this interview to unsuccessful">
               <span class="icon is-small">
                 <i class="fa fa-thumbs-o-down" aria-hidden="true" size24></i>
               </span>
             </a>
           @else
             <a class="button is_color3_d" title="Disabled because this interview is in the future and has not occurred yet or the status of this interview is set to either unsuccessful or canceled" disabled>
               <span class="icon is-small">
                 <i class="fa fa-thumbs-o-down" aria-hidden="true" size24></i>
               </span>
             </a>
           @endbtnUnsuccessful
           </div>
          </div>

          <!-- DELETE -->
          <div class="level-item">
            <div>
              <a href="{{ route('interviews.destroy', $interview->id) }}" class="button is-danger" title="Delete"
                onclick="event.preventDefault();
                document.getElementById('delete-{{ $interview->id }}').submit();"
              >
                <span class="icon is-small">
                  <i class="fa fa-trash-o size24"></i>
                </span>
              </a>
              <form id="delete-{{ $interview->id }}" action="{{ route('interviews.destroy' , $interview->id) }}" method="POST" class="is-hidden">
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

        <alert-bulma msg="No interviews found! If using filters, try selecting another filter to get a different result or to create a new record click " url="{{route('interviews.jobList')}}" klass="is-warning"></alert-bulma>
  @endforelse
</div>
{{ $interviews->links() }}
@endsection
