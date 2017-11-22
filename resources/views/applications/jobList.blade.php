@extends('layouts.master')

@section('title', 'Jobs')

@section('hero')
  <hero-dashboard
    header="List of current Job openings"
    subheader='This view displays your saved filtered jobs that have not been flagged as "closed" or "application submitted".'
  >
  </hero-dashboard>
@endsection

@section('content')

  @if(count($jobs))
    <div class="columns is-multiline">
      @foreach($jobs as $job)
        <div class="column is-one-quarter">

          <div class="card">
            <div class="card-content">
              <p class="title">
                <a href="{{ route('employers.show', $job->employer->name) }}"></a>
                {{ $job->employer->name }}
              </p>
              <p class="subtitle">
                {{ $job->title }}
              </p>
            </div>
            <footer class="card-footer">

              <!-- VIEW BUTTON -->
              <card-view-button link="{{ route('jobs.show', $job->identifier) }}"></card-view-button>

             <!-- EDIT BUTTON -->
             <card-edit-button link="{{ route('jobs.edit', $job->identifier) }}"></card-edit-button>

             <!-- DELETE BUTTON -->
             @deleteButton($job)
              <a href="{{ route('jobs.destroy', $job->identifier) }}" class="card-footer-item"
                onclick="event.preventDefault();
                document.getElementById('delete-{{ $job->id }}').submit();"
                title="Delete"
                >
                <span class="icon is-small">
                  <i class="ion-trash-a size24"></i>
                </span> 
              </a>
             @else
              <card-delete-button title="Button is disabled because this job is associated with a submitted application!"></card-delete-button>
             @enddeleteButton
            </footer>

            <!-- APPLICATION CREATE FORM -->
            @activeButton($job->has_submitted)
              <a href="{{ route('applications.create', $job->identifier) }}" class="button is-primary card-footer-item">
                <span class="icon">
                  <i class="ion-toggle-filled size24"></i>
                </span> &nbsp; &nbsp; Add submittal details for this job
              </a>
            @else
              <a class="button is-primary card-footer-item" disabled>
                <span class="icon">
                  <i class="ion-toggle-filled size24"></i>
                </span> &nbsp; &nbsp; Add submittal details for this job
              </a>
            @endactiveButton
          </div>

            <form id="delete-{{ $job->id }}" action="{{ route('jobs.destroy', $job->identifier) }}" method="POST" style="display: none;">
              {{csrf_field()}}
              {{method_field('DELETE')}}
              <input class="btn is-sm is-danger" type="submit" value="Delete">
            </form>

          </div>
      @endforeach
    </div>
  @else
    <alert-bulma msg="There isn't any jobs to file an application submission to! If you previously created records for job postings then you either updated those jobs as CLOSED or SUBMITTED - meaning that you might have flagged those jobs as no longer available or as having already submitted an application to (you may only submit one application for each job defined). To create a new record for a job opportunity, you can click on [Create Content] then select the option [Add info about Job]" klass="is-warning"></alert-bulma>
  @endif

@endsection
