@extends('layouts.master_NoSideNav')

@section('hero')
  <hero-dashboard
    header="Overview"
    subheader="A summary of the most essential information about your job search">
  </hero-dashboard>
@endsection

<!-- //====================
    //== THE BOXED SUMMARY HIGHLIGHTS IN THE MID-SECTION
   //==================== -->
@section('content')
<section-title title="Summary of Your Job Search"></section-title>

  <div class="banner">
    <div class="columns">
      <div class="column is-10 is-offset-1">
        <nav class="level">

          <highlights info="{{ $resumes }}" heading="Resumes"></highlights>

          <highlights info="{{ $completed_interviews }}" heading="completed Interviews"></highlights>

          <highlights info="{{ $upcoming_interviews }}" heading="upcoming Interviews"></highlights>

          <highlights info="{{ $offers }}" heading="Offers received"></highlights>

        </nav>
      </div>
    </div>
    <div class="columns">
      <div class="column is-10 is-offset-1">
        <nav class="level">

          <highlights info="{{ $submitted_applications }}" heading="Submitted Applications"></highlights>

          <highlights info="{{ $pending_applications }}" heading="Pending Applications"></highlights>

          <highlights info="{{ $applications_week }}" heading="Number of applications submitted this week"></highlights>

          <highlights info="{{ $app_last_date }}" heading="Your last application was submitted on"></highlights>

        </nav>
      </div>
    </div>
  </div>

  <!-- //====================
      //== FILTERS
     //==================== -->
  <div class="columns mgt_1 mgb_1">
    <div class="column is-8 is-offset-2 pda_1">
      <nav class="level">
        <div class="left">        </div>

        <div class="level-right">
          <p class="level-item has-text-centered">
            <a href="{{ route('overview') }}" class="button {{ set_filter_active('overview') }}">All job applications</a>
          </p>
          <p class="level-item has-text-centered">
            <a href="{{ route('overview.upcoming-interviews') }}" class="button {{ set_filter_active('upcoming-interviews') }}">Upcoming Interviews</a>
          </p>
          <p class="level-item has-text-centered">
            <a href="{{ route('overview.old-interviews') }}" class="button {{ set_filter_active('old-interviews') }}">Old Interviews</a>
          </p>
          <p class="level-item has-text-centered">
            <a href="{{ route('overview.no-success') }}" class="button {{ set_filter_active('no-succcess') }}">Unsuccessful Applications</a>
          </p>
        </div>
      </nav>
    </div>
  </div>

@if(confirm_filter($jobsWithUpcomingInterviews) || confirm_filter($jobsWithPastInterviews) || confirm_filter($jobsWithNoInterviews) || confirm_filter($jobsWithNoSuccess))
    <!-- //====================
        //== HEADER
       //==================== -->
    <div class="columns mgt_1 mgb_1">
      <div class="column is-8 is-offset-2 color_hero2 pda_1">
        <div class="columns ">
          <div class="column is-2"><p class="heading">Employer</p></div>
          <div class="column is-2"><p class="heading">Job Title</p></div>
          <div class="column is-2"><p class="heading">Job Location</p></div>
          <div class="column is-2"><p class="heading">Date of submission</p></div>
          <div class="column is-2"><p class="heading">Interviews</p></div>
          <div class="column"><p class="heading">Status</p></div>
        </div>
      </div>
    </div>

    <!-- //====================
        //== TABLE
       //==================== -->
    <div class="columns mgt_1 is_color10 mgb_1">
      <div class="column is-8 is-offset-2 has_borders pda_1">

        <!-- JOBS WITH UPCOMING INTERVIEWS -->
        @if(isset($jobsWithUpcomingInterviews))
          @include('overviews.partials._upcoming')
        @endif

        <!-- JOBS WITH PAST INTERVIEWS -->
        @if(isset($jobsWithPastInterviews))
          @include('overviews.partials._past')
        @endif

        <!-- JOBS WITH NO INTERVIEWS -->
        @if(isset($jobsWithNoInterviews))
          @include('overviews.partials._noInterviews')
        @endif

        <!-- JOBS WITH NO SUCCESS -->
        @if(isset($jobsWithNoSuccess))
          @include('overviews.partials._noSuccess')
        @endif

      </div>
    </div>

  @else

    <alert-bulma msg="No records found! You may select another filter to view different values" klass="is-warning"></alert-bulma>
  @endif

@endsection
