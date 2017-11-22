@extends('layouts.master')

@section('title', 'New Resume')

@section('hero')
  <hero-dashboard
    header="Create new Resume"
    subheader="Complete the form below to create a new resume record">
  </hero-dashboard>
@endsection

@section('content')

    <div class="columns">
      <div class="column is-8 is-offset-1 is_color6">
        <dashboard-title title="New Resume"></dashboard-title>

          <section class="mgt_3">

            <form id="form" action="{{ url('resumes') }}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}

              <!-- ICON -->
              <form-tooltip title="Required fields are marked with red border"></form-tooltip>

              <!-- TITLE -->
              <div class="field">
                <p class="control">
                  <input name="title" type="text" class="input is-large is-danger" value="{{ old('title') }}" placeholder="give a unique title to your resume" required
                    @focusin="removeMsg"
                  >
                </p>
              </div>

              <!-- FOLDER WHERE RESUME IS STORED -->
              <div class="field">
                <p class="control">
                  <input name="folder" type="text" class="input is-large" value="{{ old('folder') }}" placeholder="Folder/location where your Resume is stored locally/Dropbox/Google Drive">
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
                  <input name="last_update" type="date" class="input is-large" value="{{ date('Y-m-d') }}">
                </p>
                <form-tooltip title="The date resume was updated last"></form-tooltip>
              </div>

              <!-- RESUME UPLOAD -->
              <div class="file is-boxed">
                <label class="file-label">
                  <input name="file" type="file" class="file-input" >
                  <span class="file-cta">
                    <span class="file-icon">
                      <i class="fa fa-upload"></i>
                    </span>
                    <span class="file-label">
                      Upload resume
                    </span>
                  </span>
                </label>
                <form-tooltip title="Upload as a document or as pdf format"></form-tooltip>
              </div>


              <form-buttons url="/resumes" button="Submit"></form-buttons>

            </form>
          </section>

          <form-footnote></form-footnote>

      </div>
    </div>
@endsection
