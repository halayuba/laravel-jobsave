@extends('layouts.master')

@section('title', 'New Offer')

@section('hero')
  <hero-dashboard
    header="Job Offer"
    subheader="Complete the form below to create a new record for a job offer.">
  </hero-dashboard>
@endsection

@section('content')

    <div class="columns">
      <div class="column is-8 is-offset-1 is_color6">

        <!-- //====================
          //== SHOW SUMMARY INFO ABOUT THE JOB UNDER CONSIDERATION
        //==================== -->
        <div class="notification is-info">
          [This is in reference to job ({{ $job->title }}) with employer ({{ $job->employer->name }})]. Use this form to provide details about a job offer you received from this employer.
        </div>

        <dashboard-title title="Job Offer"></dashboard-title>

          <section class="mgt_3">

            <form id="form" action="{{ route('offers.store', $job->identifier) }}" method="post">
              {{csrf_field()}}

              <!-- NOTIFICATION ICON -->
              <form-tooltip title="Required fields are marked with red border"></form-tooltip>

              <!-- DATE OF OFFER -->
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Offer received on
                  </a>
                </p>
                <p class="control">
                  <input name="date" type="date" class="input is-large is-danger" value="{{ old('date')?: date('Y-m-d') }}" required>
                </p>
                &nbsp;<form-tooltip title="Dates in the future will not be accepted"></form-tooltip>
              </div>

              <!-- AMOUNT -->
              <div class="field">
                <p class="control has-icon">
                  <input name="amount" type="text" class="input is-large" value="{{ old('amount') }}" placeholder="Offer amount">
                  <span class="icon">
                    <i class="ion-social-usd"></i>
                  </span>
                </p>
              </div>

              <!-- DETAILS -->
              <div class="field">
                <p class="control">
                  <textarea name="details" class="textarea" placeholder="Use this field to enter any details related to the offer received">{{ old('details') }}</textarea>
                </p>
              </div>

              <!-- NOTES -->
              <div class="field">
                <p class="control">
                  <textarea name="notes" class="textarea" placeholder="Notes - any other notes not related to this offer. For example Starting Date, etc.">{{ old('notes') }}</textarea>
                </p>
              </div>

              <!-- CHECKBOX: is_accepted -->
              <div class="field">
                <p class="control">
                    <input name="is_accepted" type="checkbox" id="is_accepted" class="css3checkbox" >
                    <label for="is_accepted" class="toggler">I have accepted this job offer</label>
                </p>
              </div>

              <form-buttons button="Submit" url="/offers"></form-buttons>

            </form>
          </section>

          <form-footnote></form-footnote>
      </div>
    </div>

@endsection
