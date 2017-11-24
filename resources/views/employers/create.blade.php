@extends('layouts.master')

@section('title', 'Employer Create')

@section('hero')
  <hero-dashboard
    header="Create new Employer"
    subheader="Complete the form below to create a record for a new employer that you wish to submit a resume to one of his job openings">
  </hero-dashboard>
@endsection

@section('content')

    <div class="columns">
      <div class="column is-8 is-offset-1 is_color6">
        <dashboard-title title="New Employer Record"></dashboard-title>

          <section class="mgt_3">

              <form id="form" action="{{ url('employers') }}" method="post">
                {{csrf_field()}}

                <!-- ICON -->
                <form-tooltip title="Required fields are marked with red border"></form-tooltip>

                <!-- NAME -->
                <div class="field">
                  <p class="control has-icon">
                    <input name="name" type="text" class="input is-large is-danger" value="{{ old('name') }}" placeholder="Employer Name" required
                      @focusin="removeMsg"
                    >
                    <span class="icon">
                      <i class="fa fa-building-o"></i>
                    </span>
                  </p>
                </div>

                <!-- ADDRESS -->
                <div class="field">
                  <p class="control has-icon">
                    <textarea name="address" class="textarea" placeholder="Employer address: if you don't know the full address then you can make a reference to the town/city">{{ old('address') }}</textarea>
                  </p>
                </div>

                <!-- EMAIL -->
                <div class="field">
                  <p class="control has-icon">
                    <input name="email" type="email" class="input is-large" value="{{ old('email') }}" placeholder="Employer email address">
                    <span class="icon">
                      <i class="fa fa-envelope-square"></i>
                    </span>
                  </p>
                </div>

                <!-- PHONE -->
                <div class="field">
                  <p class="control has-icon">
                    <input name="phone" type="phone" class="input is-large" value="{{ old('phone') }}" placeholder="Employer contact number">
                    <span class="icon">
                      <i class="fa fa-phone-square"></i>
                    </span>
                  </p>
                </div>

                <!-- WEBSITE -->
                <div class="field">
                  <p class="control has-icon">
                    <input name="website" type="url" class="input is-large" value="{{ old('website') }}" placeholder="Employer Website">
                    <span class="icon">
                      <i class="fa fa-globe"></i>
                    </span>
                  </p>
                </div>

                <!-- LINKEDIN -->
                <div class="field">
                  <p class="control has-icon">
                    <input name="linkedin" type="url" class="input is-large" value="{{ old('linkedin') }}" placeholder="Employer Linked-in page">
                    <span class="icon">
                      <i class="fa fa-linkedin-square"></i>
                    </span>
                  </p>
                </div>

                <!-- INDUSTRY -->
                <div class="field has-addons">
                  <p class="control">
                    <a class="button is-static is-large">
                      Industry
                    </a>
                  </p>
                  <p class="control">
                    <span class="select is-large">
                      <select name="industry_id" class="">
                        @foreach($industries as $industry)

                          {{ $selected = ( old('industry_id') == $industry->id)? ' selected': '' }}

                          <option value="{{ $industry->id }}" {{$selected}}>{{ $industry->name }}</option>
                        @endforeach
                      </select>
                    </span>
                  </p>
                </div>

                <form-buttons url="/employers" button="Submit"></form-buttons>

              </form>
          </section>
          <form-footnote></form-footnote>
      </div>
    </div>

@endsection
