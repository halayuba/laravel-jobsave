<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Offer, Job, Interview};
use Gate;

class OfferController extends Controller
{
    public function index()
    {
      if(request(['filter']))
      {
        $offers = Offer::filter(request(['filter']))->with('job.employer')->get();
      }
      else
      {
        $offers = Offer::mostRecent()->with('job.employer')->get();
      }
      return view("offers.index", compact('offers'));
    }

    public function create(Job $job)
    {
      if($job->offer)
      {
        return back()->with(flash_message("is-warning", "It appears that you have previously created an offer for this job opportunity, and therefore you can not create another offer for the same job!"));
      }
      return view("offers.create", compact('job'));
    }

    public function store(Request $request, Job $job)
    {
      request()->validate([
        'date' => 'required',
      ]);

      if(Gate::denies('offers_dates', $job))
      {
        return back()->withInput($request->all())
          ->with(flash_message("is-warning", "Warning! The date you entered for the offer must be before the current date and must not come before the date you had your interview!"));
      }

      $offer = new Offer([
        'date' => $request->date,
        'amount' => $request->amount,
        'details' => $request->details,
        'notes' => $request->notes,
        'is_accepted' => ($request->get('is_accepted') == 'on')? true : false
      ]);

      $offer = $offer->user()->associate($request->user());

      $job->offer()->save($offer);

      return redirect('offers')->with(flash_message('is-success', 'Offer has successfully been created!'));

    }

    public function edit(Offer $offer)
    {
      return view("offers.edit", compact('offer'));
    }

    public function update(Request $request, Offer $offer)
    {
      if($offer->is_archived)
      {
        $request = request()->only(['amount', 'details', 'notes']);
      }
      else
      {
        request()->validate([
          'date' => 'required',
        ]);

        $job = $offer->job;
        if(Gate::denies('offers_dates', $job))
        {
          return back()->withInput($request->all())
          ->with(flash_message("is-warning", "Warning! The date you entered for the offer must be before the current date and must not come before the date you had your interview!"));
        }

        ///== HANDLING "is_accepted" CHECKBOX
        //====================
        $checkbox = ($request->get('is_accepted') == 'on')? true : false;
        $request = request()->except(['is_accepted']);
        $request['is_accepted'] = $checkbox;
      }

      $offer->update($request);
      return redirect('offers')->with(flash_message('is-success', 'You have successfully updated the details of your offer!'));

    }

    public function statusUpdateAccept(Offer $offer)
    {
      if($offer->job->has_closed)
      {
        return back()->with(flash_message("is-warning", "Action is not permitted"));
      }
      else $offer->accepted();

      return redirect("offers")->with(flash_message("is-success", "The offer has now a status of accepted"));
    }

    public function statusUpdateDecline(Offer $offer)
    {
      $offer->rejected();
      return redirect("offers")->with(flash_message("is-success", "The status of your offer has changed to rejected"));
    }

    public function destroy(Offer $offer)
    {
      $offer->delete();
      return redirect('/offers')->with(flash_message('is-success', 'Offer has been deleted successfully.'));
    }


  /* //====================
    //== INTERVIEWLIST: LIST OF INTERVIEWS WITH POTENTIAL OFFERS
   //==================== */
    public function interviewList(Job $job)
    {
      $interviews = Interview::interviewsWithPotentialOffers()->with('job.employer', 'interview_type')->get();
      return view("offers.interviewList", compact('interviews'));
    }

}
