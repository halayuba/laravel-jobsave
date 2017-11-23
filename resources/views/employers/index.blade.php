@extends('layouts.master')

@section('title', 'List of Employers')

@section('hero')
  <hero-dashboard
    header="List of all Employers"
    subheader="You can edit, delete, or add a new employer. If you'd like to define a job opportunity posted by one of the employers in the list, click on [Go to Job form] button. Warning: attempting to delete (archive) an employer will also delete (archive) the associated jobs, applications, interviews, and offers from that employer (if previously defined)."
  >
  </hero-dashboard>
@endsection

@section('content')

  <!-- //====================
      //== FILTERS
     //==================== -->
     @employers_count
      <div class="columns mgb_1">
        <div class="column is-8 is-offset-1 pda_1">
          <nav class="level">
            <div class="left">        </div>

            <div class="level-right">

              <p class="level-item has-text-centered">
                <a href="/employers" class="button {{ set_nav_active('') }}">All active employers</a>
              </p>
              <p class="level-item has-text-centered">
                <a href="/employers?filter=archived" class="button {{ set_nav_active('archived') }}">Archived employers</a>
              </p>

            </div>
          </nav>
        </div>
      </div>
      @endemployers_count

<div class="section">
  @forelse($employers as $employer)

    <div class="columns">
      <div class="column is-11">
          <article class="media">
            <div class="media-content">
              <div class="content">

                <!-- EMPLOYER NAME -->
                <p class="title is-4 mgb_1">
                  {{ $employer->name }}

                  @if(count($employer->jobs) > 0)
                    <a href="{{ url('jobs/employers/'.$employer->name) }}">
                      <span class="tag is-info" title="Total jobs stored for this employer. Click to view">
                          {{count($employer->jobs)}}
                      </span>
                    </a>
                  @else
                    <span class="tag is-info" title="There are no jobs associated with this employer yet.">
                      {{count($employer->jobs)}}
                    </span>
                  @endif
                </p>

                <!-- EMPLOYER ADDRESS -->
                <p class="subtitle is-6">{{ $employer->address }}</p>
                <div class="mgt_1"> </div>

                <div class="level notification">

                  <!-- EMPLOYER EMAIL -->
                  <div class="level-item">
                    <p class="heading">
                      <i class="fa fa-envelope-square size18" title="{{ $employer->email }}"></i>
                      {{ truncate_field($employer->email) }}
                    </p>
                  </div>

                  <!-- EMPLOYER PHONE -->
                  <div class="level-item">
                    <p class="heading">
                      <i class="fa fa-phone-square size18"></i>
                      {{ $employer->phone }}
                    </p>
                  </div>

                  <!-- EMPLOYER OFFICIAL WEBSITE -->
                  <div class="level-item">
                    <p class="heading">
                      <i class="fa fa-globe size18"></i>
                      @if($employer->website)
                        <a href="{{ $employer->website }}" class="is_link">{{ clean_url($employer->website) }}</a>
                      @endif
                    </p>
                  </div>

                  <!-- EMPLOYER LINKED-IN -->
                  <div class="level-item">
                    <p class="heading">
                      <i class="fa fa-linkedin-square size18" title="Linked-in"></i>
                      @if($employer->linkedin)
                        <a href="{{ $employer->linkedin }}" class="is_link">{{ clean_url($employer->linkedin) }}</a>
                      @endif
                    </p>
                  </div>
                </div>
              </div>
            </div>
            @if(!$employer->is_archived)
            <div class="media-right">
              <div class="has-text-centered">
                <a href="{{ route('jobs.createSpecific', $employer->id) }}" class="button is-info is-outlined is-small" title="Define a new job opportunity posted by this employer">
                  <span class="icon">
                    <i class="fa fa-briefcase"></i>
                  </span> &nbsp;
                  Go to Job form
                </a>
              </div>
            </div>
            @endif
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
              <a href="{{ route('employers.show', $employer->name) }}" class="button is-info" title="View the entire record">
                <span class="icon is-small">
                  <i class="fa fa-map-o size24"></i>
                </span>
              </a>
            </div>
          </div>

          @if($employer->is_archived)
            <!-- UPDATE STATUS TO ACTIVE -->
            <div class="level-item">
              <div>
                <a href="{{ route('employers.statusUpdate', $employer->name) }}" class="button is-success" title="Activate employer">
                  <span class="icon is-small">
                    <i class="fa fa-toggle-on size24"></i>
                  </span>
                </a>
              </div>
            </div>
          @else
            <!-- EDIT -->
            <div class="level-item">
              <div>
                <a href="{{ route('employers.edit', $employer->name) }}" class="button is-warning" title="Edit employer">
                  <span class="icon is-small">
                    <i class="fa fa-pencil-square-o size24"></i>
                  </span>
                </a>
              </div>
            </div>

            <!-- DELETE -->
            <div class="level-item">
              <div>
                <a href="{{ route('employers.destroy', $employer->name) }}" class="button {{ $employer->inUse()? "is_danger_d" : "is-danger" }}" title="Warning! attempting to delete (archive) an employer will also delete (archive) the associated jobs, applications, interviews, and any offers from that employer"
                  onclick="event.preventDefault();
                  document.getElementById('delete-{{ $employer->id }}').submit();"
                >
                  <span class="icon is-small">
                    <i class="fa fa-trash-o size24"></i>
                  </span>
                </a>
                <form id="delete-{{ $employer->id }}" action="{{ route('employers.destroy', $employer->name) }}" method="POST" class="is-hidden">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input class="btn is-sm is-danger" type="submit" value="Delete">
                 </form>
              </div>
            </div>
          @endif

        </nav>
      </div>

    </div>

      @empty

        <alert-bulma msg="No employers found! To create a new record click" url={{ route('employers.create') }} klass="is-warning"></alert-bulma>
  @endforelse
</div>
{{ $employers->links() }}
@endsection
