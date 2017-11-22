@extends('layouts.master')

@section('hero')
  <hero-dashboard header="Dashboard" subheader="Follow these instructions to beign feeding the system with essential information you would like to store about the jobs you're seeking.">
  </hero-dashboard>
@endsection

@section('content')
  <div class="tile is-ancestor">
    <div class="tile is-vertical is-8">
      <div class="tile">
        <div class="tile is-parent is-vertical">
          <article class="tile is-child notification is-primary">
            <p class="title">Introduction:</p>
            <p class="subtitle is_color5"><strong>Feeding the system with data is your responsibility ... Job Save will give you a summarized overview as a result</strong>.
              Job Save can be a very helpful tool for job seekers by allowing them to keep all miscellaneous information, throughout the search for job opportunities, in one central place thus giving them an extended visibility, tracking, and record keeping at the end.
            </p>
          </article>
          <article class="tile is-child notification is-primary">
            <p class="title">Step 1: Define a new Resume <small>(Required once then optional)</small>:</p>
            <p class="subtitle is_color5">Usually, most job seekers would have one single resume but in case you have multiple variations of the main resume or if you have skills in more than one field you may <a href="{{ route('resumes.create') }}">click here</a> to create records for all your resumes. <strong>Note:</strong> at least one resume must be defined.
            </p>
          </article>
          <article class="tile is-child notification is-primary">
            <p class="title">Step 2: Create a new Employer record:</p>
            <p class="subtitle is_color5">Unless you are applying for a job with the same employer that you have already created a record for, you will need to <a href="{{ route('employers.create') }}">define a new employer</a> and the posted job that you've applied for (see next step).</p>
          </article>
          <article class="tile is-child notification is-primary">
            <p class="title">Step 3: Create a new Job record:</p>
            <p class="subtitle is_color5">Next you will need to enter information about the <a href="{{ route('jobs.create') }}">new job openning</a> that you've applied for (or wish to apply for) posted by the employer created above. This is a cornerstone step in Job Save as all other elements are tied up to the job you define. So you should give as many details as possible and re-confirm the accuracy of the information provided.
            </p>
          </article>
          <article class="tile is-child notification is-primary">
            <p class="title">Step 4: Create a new Job Application:</p>
            <p class="subtitle is_color5">With all the above information readily available, and upon applying for a new job, you would <a href="{{ url('applications/job-openings') }}">come here</a> to start filling out the application section. The goal is to ultimately have records of all the different positions you've been applying for.</p>
          </article>
          <article class="tile is-child notification is-primary">
            <p class="title">Step 5: Create a new Interview record:</p>
            <p class="subtitle is_color5">If you get confirmed for an interview,
              <a href="{{ route('interviews.jobList') }}">click here</a> to record certain usefull details about your upcoming interview. And once the interview has been conducted, you can come back to this form to enter your notes (if desired).</p>
          </article>
          <article class="tile is-child notification is-primary">
            <p class="title">Step 6: Create a new Offer:</p>
            <p class="subtitle is_color5">If you get an offer,
              <a href="{{ route('offers.interviewList') }}">click here</a> to capture details about the offer received. And once you decide on the offer, you can update the status to Offer Accepted or Offer Rejected.</p>
          </article>
          <article class="tile is-child notification is-primary">
            <p class="title">Overview: Get a helpful summary as a result</p>
            <p class="subtitle is_color5">Once you have created the various records, following the five steps above, with all the information that is important to you pertaining to your job search <a href="{{ url('overview') }}">click here</a> to obtain a concise overview.</p>
          </article>
        </div>
      </div>
    </div>
  </div>
@endsection
