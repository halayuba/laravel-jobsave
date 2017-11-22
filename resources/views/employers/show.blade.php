@extends('layouts.master')

@section('title', 'Employer details')

@section('hero')
  <hero-dashboard
    header="Employer Details"
    subheader="Details of employer record"
  >
  </hero-dashboard>
@endsection

@section('content')
  <div class="columns">
    <div class="column is-5 is-offset-2">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title title is-2">{{ $employer->name}}
            @if($employer->is_archived)
            &nbsp; &nbsp;<span class="tag is-danger"><strong>Archived</strong></span>
            @endif
          </p>
        </header>
        <div class="card-content">
          <div class="content">
            <card-content klass="ion-ios-location" label="Address" value="{{ $employer->address }}"></card-content>
            <card-content klass="ion-email" label="Email" value="{{ $employer->email }}"></card-content>
            <card-content klass="ion-ios-telephone" label="Phone" value="{{ $employer->phone }}"></card-content>
            <card-content klass="ion-earth" label="Website" value="{{ $employer->website }}"></card-content>
            <card-content klass="ion-social-linkedin" label="Linked-in" value="{{ $employer->linkedin }}"></card-content>
            <card-content klass="fa fa-building" label="Industry" value="{{ $employer->industry->name }}"></card-content>
          </div>
        </div>
        <footer class="card-footer">
          <div class="section">
            <div class="content">
              <p class="title">{{ wording(count($jobs), 'job') }} listed for this employer </p>
              @if($jobs->count())
                <ol>
                  @foreach($jobs as $job)
                  <li><a href="{{ route('jobs.show', $job->identifier)}}">{{ $job->title}}</a></li>
                  @endforeach
                </ol>
              @else
                <div class="has-text-centered">
                  <a href="{{ route('jobs.createSpecific', $employer->id) }}" class="button is-info is-outlined is-big" >
                    <span class="icon">
                      <i class="ion-briefcase"></i>
                    </span> &nbsp;
                    Go to Job form
                  </a>
                </div>
              @endif
            </div>
          </div>
        </footer>
        @if($employer->is_archived)
          <footer class="card-footer">
            <a href="/employers?filter=archived" class="card-footer-item" title="Return">
              <span class="icon is-large">
                <i class="ion-chevron-left size24"></i>
              </span>
            </a>
            <a href="{{ route('employers.statusUpdate', $employer->name) }}" class="card-footer-item" title="Activate employer">
              <span class="icon is-large">
                <i class="icon-toggle-on size24"></i>
              </span>
            </a>
          </footer>
        @else
          <footer class="card-footer">
            <!-- EDIT ACTION -->
            <card-edit-button link="{{ route('employers.edit', $employer->name) }}"></card-edit-button>

             <!-- DELETE ACTION -->
             @deleteButton($employer)
               <a href="{{ route('employers.destroy', $employer->name) }}"
                 onclick="event.preventDefault();
                 document.getElementById('delete-{{ $employer->id }}').submit();"
                 class="card-footer-item"
               >
                 <span class="icon is-small" title="Delete">
                   <i class="ion-trash-a size24"></i>
                 </span>
               </a>
             @else
              <!-- DELETING EMPLOYER IN THIS SCENARIO WILL RESULT IN ARCHIVING APPLICATIONS/INTERVIEWS/OFFERS -->
              <p class="card-footer-item" title="Attempting to delete this employer will lead to archiving any associated jobs, applications, interviews, or offers for that employer. Are you sure you want to delete this employer?">
               <a href="{{ route('employers.destroy', $employer->name) }}"
                 onclick="event.preventDefault();
                 document.getElementById('delete-{{ $employer->id }}').submit();"
                 class="button is-static"
                 >
                 <span class="icon is-small">
                   <i class="ion-trash-a size24"></i>
                 </span>
               </a>
              </p>
             @enddeleteButton
          </footer>
        @endif
      </div>
    </div>
  </div>
  <form id="delete-{{ $employer->id }}" action="{{ route('employers.destroy', $employer->name) }}" method="POST" class="is-hidden">
    {{csrf_field()}}
    {{method_field('DELETE')}}
    <input class="btn is-sm is-danger" type="submit" value="Delete">
  </form>
@endsection
