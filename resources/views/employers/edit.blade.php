@extends('layouts.master')

@section('title', 'Edit Employer')

@section('hero')
  <hero-dashboard
    header="Edit Employer details"
    subheader="Make the desired changes to the form below to update employer details">
  </hero-dashboard>
@endsection

@section('content')

    <div class="columns">
      <div class="column is-8 is-offset-1 is_color6">
        <dashboard-title title="Update Employer Details"></dashboard-title>

          <section class="mgt_3">

              <form id="form" action="{{ route('employers.update', $employer->name) }}" method="post">
                {{ csrf_field() }}
                {{ method_field("PATCH") }}

                <!-- ICON -->
                <form-tooltip title="Required fields are marked with red border"></form-tooltip>

                <!-- NAME -->
                <div class="field">
                  <p class="control has-icon">
                    <input name="name" type="text" class="input is-large is-danger" value="{{ old('name')?: $employer->name }}" required
                    @focusin="removeMsg"
                  >
                    <span class="icon">
                      <i class="ion-android-locate"></i>
                    </span>
                  </p>
                </div>

                <!-- ADDRESS -->
                <div class="field">
                  <p class="control has-icon">
                    <textarea name="address" class="textarea" placeholder="Address: if you don't know the full address then you can make a reference to the town/city" >{{ old('address')?: $employer->address }}</textarea>
                  </p>
                </div>

                <!-- EMAIL -->
                <div class="field">
                  <p class="control has-icon">
                    <input name="email" type="email" class="input is-large" value="{{ old('email')?: $employer->email }}" placeholder="email address" >
                    <span class="icon">
                      <i class="ion-email"></i>
                    </span>
                  </p>
                </div>

                <!-- PHONE -->
                <div class="field">
                  <p class="control has-icon">
                    <input name="phone" type="phone" class="input is-large" value="{{ old('phone')?: $employer->phone }}" placeholder="contact number" >
                    <span class="icon">
                      <i class="ion-ios-telephone"></i>
                    </span>
                  </p>
                </div>

                <!-- WEBSITE -->
                <div class="field">
                  <p class="control has-icon">
                    <input name="website" type="url" class="input is-large" value="{{ old('website')?: $employer->website }}" placeholder="Employer's Website" >
                    <span class="icon">
                      <i class="ion-ios-world"></i>
                    </span>
                  </p>
                </div>

                <!-- LINKEDIN -->
                <div class="field">
                  <p class="control has-icon">
                    <input name="linkedin" type="url" class="input is-large" value="{{ old('linkedin')?: $employer->linkedin }}" placeholder="Employer's Linked-in page" >
                    <span class="icon">
                      <i class="ion-social-linkedin"></i>
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
                          <option value="{{ $industry->id }}" {{ selected(old('industry_id'), $industry->id, $employer->industry_id) }}>{{ $industry->name }}</option>
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
