@extends('layouts.master')

@section('title', 'Edit Resume')

@section('hero')
  <hero-dashboard
    header="Edit Resume"
    subheader="Update details">
  </hero-dashboard>
@endsection

@section('content')

    <div class="columns">
      <div class="column is-8 is-offset-1 is_color6">
        <dashboard-title title="Update Resume"></dashboard-title>

          <section class="mgt_3">

            <form id="form" action="{{ route('resumes.update', $resume->title) }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              {{ method_field("PATCH") }}

              <!-- ICON -->
              <form-tooltip title="Required fields are marked with red border"></form-tooltip>

              <!-- TITLE -->
              <div class="field">
                <p class="control">
                  <input name="title" type="text" class="input is-large is-danger" value="{{ old('title')?: $resume->title }}" required>
                </p>
              </div>

              <!-- FOLDER WHERE RESUME IS STORED -->
              <div class="field">
                <p class="control">
                  <input name="folder" type="text" class="input is-large" placeholder="{{ ($resume->folder == NULL)? 'Folder/location where your Resume is stored locally/Dropbox/Google Drive' : '' }}" value="{{ old('folder')?: $resume->folder }}">
                </p>
              </div>

              <!-- DATE -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Last update
                  </a>
                </p>
                <p class="control">
                  <input name="last_update" type="date" class="input is-large" value="{{ optional($resume->last_update)->toDateString() }}">
                </p>
                <form-tooltip title="The date resume was updated last"></form-tooltip>
              </div>

              <!-- RESUME UPLOAD -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Upload resume
                  </a>
                </p>
                <p class="control">
                  <input name="file" type="file" class="input is-large">
                </p>
                <form-tooltip title="Upload as a Word document or as pdf format"></form-tooltip>
                <p class="control">
                  <span class="is_color2 mgl_1">{{ str_after($resume->file, 'public/resumes/') }}</span>
                </p>
              </div>

              <form-buttons url="/resumes" button="Submit"></form-buttons>

            </form>
          </section>

          <form-footnote></form-footnote>

      </div>
    </div>

@endsection
