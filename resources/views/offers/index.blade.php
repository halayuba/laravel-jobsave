@extends('layouts.master')

@section('title', 'Offers')

@section('hero')
  <hero-dashboard
    header="List of all offers"
    subheader="This view shows your offers. You can update or delete offers, or add a new offer from the [Create Content] from the side navigation"
  >
  </hero-dashboard>
@endsection

@section('content')

  <!-- //====================
      //== FILTERS
     //==================== -->
     @offers_count
      <div class="columns mgb_1">
        <div class="column is-8 is-offset-1 pda_1">
          <nav class="level">
            <div class="left">        </div>

            <div class="level-right">

              <p class="level-item has-text-centered">
                <a href="/offers" class="button {{ set_nav_active('') }}">Current active offers</a>
              </p>
              <p class="level-item has-text-centered">
                <a href="/offers?filter=rejected" class="button {{ set_nav_active('rejected') }}">Rejected offers</a>
              </p>

            </div>
          </nav>
        </div>
      </div>
      @endoffers_count

<div class="section">

  @forelse($offers as $offer)

    <div class="columns">
      <div class="column is-10">
          <article class="media">
            <div class="media-content">
              <div class="content">

                <!-- EMPLOYER NAME / JOB TITLE -->
                <p class="title is-4">
                  <i class="icon-at-sign size18" aria-hidden="true"></i>
                  <a href="{{ route('employers.show', $offer->job->employer->name )}}">
                    {{ $offer->job->employer->name }}
                  </a>
                  &nbsp;
                  <i class="icon-briefcase size18" aria-hidden="true"></i>
                  <a href="{{ route('jobs.show', $offer->job->identifier) }}">
                    {{ $offer->job->title }}
                  </a>
               </p>

              <!-- NOTES -->
              <p class="subtitle is-6">{{ $offer->notes }}</p>

              <div class="level notification">

                <!-- AMOUNT -->
                <div class="level-item">
                  <p class="heading">
                    <span class="icon">
                      <i class="ion-cash size18" title="Offer amount"></i>
                    </span>
                    {{ $offer->amount }}
                  </p>
                </div>

                <!-- DATE -->
                <div class="level-item">
                  <p class="heading">
                    <span class="icon">
                      <i class="ion-android-calendar size18" title="Offer received on"></i>
                    </span>
                    {{ optional($offer->date)->toFormattedDateString() }}
                  </p>
                </div>

                <!-- DETAILS -->
                <div class="level-item">
                  <p class="heading">
                    <i class="icon-label size18" title="Offer details"></i>
                    <span title="{{ $offer->details }}">{{ truncate_field($offer->details) }}</span>
                  </p>
                </div>

                <!-- OFFER ACCEPTED -->
                  @if($offer->is_accepted)
                    <div class="level-item">
                      <span class="tag is-success" title="You have accepted this offer">
                        <span class="icon">
                          <i class="fa fa-thumbs-o-up" aria-hidden="true" size24></i>
                        </span>
                      </span>
                    </div>
                  @elseif($offer->is_archived)
                    <div class="level-item">
                      <span class="tag is-danger" title="You have rejected this offer">
                        <span class="icon">
                          <i class="fa fa-thumbs-o-down" aria-hidden="true" size24></i>
                        </span>
                      </span>
                    </div>
                  @else
                    <div class="level-item">
                      <span class="tag is-warning"><strong>Undecided</strong></span>
                    </div>
                  @endif
              </div>
              </div>
            </div>
          </article>
        <div class="seperator"></div>
      </div>

<!-- //====================
    //== ACTIONS:
   //==================== -->
      <div class="column">
        <nav class="level is-mobile">

         <!-- UPDATE OFFER STATUS TO ACCEPTED -->
           <div class="level-item">
             <div>
               @btnAcceptOffer($offer)
                <a href="{{ route('offers.statusUpdateAccept', $offer->id) }}" class="button is-info" title="Update the status of this offer to accepted">
                  <span class="icon is-small">
                    <i class="fa fa-thumbs-o-up" aria-hidden="true" size24></i>
                  </span>
                </a>
              @else
                <a href="#" class="button is-static">
                  <span class="icon is-small" title="Button is disabled because condition is not met">
                    <i class="fa fa-thumbs-o-up" aria-hidden="true" size24></i>
                  </span>
                </a>
              @endbtnAcceptOffer
            </div>
          </div>


          <!-- UPDATE OFFER STATUS TO REJECTED -->
          <div class="level-item">
            <div>
              @btnRejectOffer($offer)
               <a href="{{ route('offers.statusUpdateDecline', $offer->id) }}" class="button is_color12" title="Update the status of this offer to rejected">
                 <span class="icon is-small">
                   <i class="fa fa-thumbs-o-down" aria-hidden="true" size24></i>
                 </span>
               </a>
              @else
                <a href="#" class="button is-static">
                  <span class="icon is-small" title="Button is disabled because condition is not met">
                    <i class="fa fa-thumbs-o-down" aria-hidden="true" size24></i>
                  </span>
                </a>
              @endbtnRejectOffer
             </div>
            </div>

          <!-- EDIT -->
          <div class="level-item">
            <div>
              <a href="{{ route('offers.edit', $offer->id) }}" class="button is-warning" title="Edit">
                <span class="icon is-small">
                  <i class="ion-compose size24"></i>
                </span>
              </a>
            </div>
          </div>

          <!-- DELETE -->
          <div class="level-item">
            <div>
              <a href="{{ route('offers.destroy', $offer->id) }}" class="button is-danger" title="Delete"
                onclick="event.preventDefault();
                document.getElementById('delete-{{ $offer->id }}').submit();"
              >
                <span class="icon is-small">
                  <i class="ion-trash-a size24"></i>
                </span>
              </a>
              <form id="delete-{{ $offer->id }}" action="{{ route('offers.destroy' , $offer->id) }}" method="POST" class="is-hidden">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <input class="btn is-sm is-danger" type="submit" value="Delete">
              </form>
            </div>
          </div>

        </nav>
      </div>

    </div>

      @empty

        <alert-bulma msg="No offers found! to create a new record click " url="{{route('offers.interviewList')}}" klass="is-warning"></alert-bulma>
  @endforelse
</div>

@endsection
