@extends('layouts.master')

@section('title', 'Update Offer')

@section('hero')
  <hero-dashboard
    header="Job Offer"
    subheader="Update job offer">
  </hero-dashboard>
@endsection

@section('content')

    <div class="columns">
      <div class="column is-8 is-offset-1 is_color6">

        <dashboard-title title="Update Offer"></dashboard-title>

          <section class="mgt_3">

            <form id="form" action="{{ route('offers.update', $offer->id) }}" method="post">
              {{csrf_field()}}
              {{ method_field("PATCH") }}

              <!-- NOTIFICATION ICON -->
              <form-tooltip title="Required fields are marked with red border"></form-tooltip>

              <!-- DATE OF OFFER -->
              @if($offer->is_archived)
                <disabled-field label="Offer date" value="{{ $offer->date->toDateString() }}"></disabled-field>
              @else
              <div class="field has-addons">
                <p class="control">
                  <a class="button is-static is-large">
                    Offer received on
                  </a>
                </p>
                <p class="control">
                  <input name="date" type="date" class="input is-large is-danger" value="{{ $offer->date->toDateString() }}" required>
                </p>
                &nbsp;<form-tooltip title="Dates in the future will not be accepted"></form-tooltip>
              </div>
              @endif

              <!-- AMOUNT -->
              <div class="field">
                <p class="control has-icon">
                  <input name="amount" type="text" class="input is-large" value="{{ $offer->amount }}" placeholder="Offer amount">
                  <span class="icon">
                    <i class="ion-social-usd"></i>
                  </span>
                </p>
              </div>

              <!-- DETAILS -->
              <div class="field">
                <p class="control">
                  <textarea name="details" class="textarea" placeholder="Use this field to enter any details related to the offer received">{{ $offer->details }}</textarea>
                </p>
              </div>

              <!-- NOTES -->
              <div class="field">
                <p class="control">
                  <textarea name="notes" class="textarea" placeholder="Notes - any other notes. For example, if you rejected this offer, why?">{{ $offer->notes }}</textarea>
                </p>
              </div>

              @if($offer->is_archived)
                <alert-nobtn msg="The status of this offer is set to either rejected or archived so the offer date and status can not be changed!" klass="is-warning"></alert-nobtn>
              @else
              <!-- CHECKBOX: is_accepted -->
              <div class="field">
                <p class="control">
                    <input name="is_accepted" type="checkbox" id="is_accepted" class="css3checkbox" {{ $offer->is_accepted? ' checked' : '' }}>
                    <label for="is_accepted" class="toggler">I have accepted this job offer</label>
                </p>
              </div>
              @endif

              <form-buttons button="Submit" url="/offers"></form-buttons>

            </form>
          </section>

          <form-footnote></form-footnote>
      </div>
    </div>

@endsection
