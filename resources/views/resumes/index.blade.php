@extends('layouts.master')

@section('title')
  Resumes
@endsection

@section('hero')
  <hero-dashboard
    header="List of all Resumes"
    subheader="If you use more than one resume when applying for different jobs then click on [Create Content] to create a new resume. Use this view to delete or edit resumes. Note: resumes associated with submitted job applications can not be deleted."
  >
  </hero-dashboard>
@endsection

@section('content')

  @if(count($resumes))
  <div class="columns is-multiline">
    @foreach($resumes as $resume)
      <div class="column is-one-third">

        <div class="card">
          <header class="card-header">
            <p class="card-header-title">
              {{ $resume->title }}
            </p>
          </header>
          <div class="card-content">
            <div class="content">
              <card-content klass='ion-android-folder-open' label="Stored in folder" value="{{ valueOrText($resume->folder) }}"></card-content>

              <card-content klass='ion-clock' label="Last Update" value="{{ optional($resume->last_update)->toFormattedDateString() }}"></card-content>

              <card-content klass='ion-document-text' label="Resume" value="{{ ($resume->file !== NULL)? str_after($resume->file, 'public/resumes/') : 'not provided'  }}"></card-content>
            </div>
          </div>
          <footer class="card-footer">

            <!-- DOWNLOAD ACTION -->
            @downloadButton($resume)
              <a href="{{ route('resumes.download', $resume->title) }}" class="card-footer-item">
                <span class="icon is-small" title="Download">
                  <i class="ion-ios-download-outline size24"></i>
                </span>
              </a>
            @else
              <card-download-button title="The Download button is disabled because attachment was not provided"></card-download-button>
            @enddownloadButton

           <!-- EDIT ACTION -->
            <card-edit-button link="{{ route('resumes.edit', $resume->title) }}"></card-edit-button>

            <!-- DELETE ACTION -->
            @deleteButton($resume)
              <a href="{{ route('resumes.destroy', $resume->title) }}"
                onclick="event.preventDefault();
                document.getElementById('delete-{{ $resume->id }}').submit();"
                class="card-footer-item"
              >
                <span class="icon is-small" title="Delete">
                  <i class="ion-trash-a size24"></i>
                </span>
              </a>
            @else
              <card-delete-button title="The Delete button is disabled because this resume is associated with a submitted application!"></card-delete-button>
            @enddeleteButton
          </footer>
        </div>

          <form id="delete-{{ $resume->id }}" action="{{ route('resumes.destroy', $resume->title) }}" method="POST" class="is-hidden">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <input class="btn is-sm is-danger" type="submit" value="Delete">
          </form>

      </div>
    @endforeach

    <!-- CARD TO ADD A NEW RECORD -->
    <div class="column is-one-third">
      <div class="card">
        <div class="card-header">
          <div class="card-header-title">
            Need to add another resume?
          </div>
          <footer class="card-footer">
            <a href="{{ route('resumes.create') }}" class="card-footer-item">new resume</a>
          </footer>
        </div>
      </div>
    </div>

  </div>

  @else

    <alert-bulma msg="No resumes found! To create a new record click " klass="is-warning" url={{ route('resumes.create') }}></alert-bulma>
  @endif

@endsection
