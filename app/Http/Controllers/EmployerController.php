<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employer;
use App\Events\ActionDeleteEmployerInUse;

use Illuminate\Validation\Rule;

class EmployerController extends Controller
{
    protected $employer;

    public function __construct(Employer $employer)
    {
        $this->employer = $employer;
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

/* //====================
  //== INDEX
 //==================== */
    public function index()
    {
      if(request(['filter']))
      {
        $employers = Employer::filter(request(['filter']))->with('jobs')->paginate(8);
      }
      else
      {
        $employers = Employer::current()->with('jobs')->paginate(8);
      }
      return view("employers.index", compact('employers'));
    }

/* //====================
  //== CREATE
 //==================== */
    public function create()
    {
      return view("employers.create");
    }

/* //====================
  //== STORE //new , Rule::unique('name', 'user_id')->ignore($employer->id)
 //==================== */
    public function store(Request $request, Employer $employer)
    {
      request()->validate([
        'name' => [
          'required',
          'min:3',
          'max:55',
          new \App\Rules\UniqueEmployerPerUser
        ],
        'email' => 'max:250',
        'phone' => 'max:20',
        'website' => 'max:255',
        'linkedin' => 'max:255',
    ]);

      $request->user()->employers()->create($request->all());
      return redirect('employers')->with(flash_message('is-success', 'A new Employer has been created successfully!'));
    }

/* //====================
  //== SHOW
 //==================== */
    public function show(Employer $employer)
    {
      $jobs = $employer->jobs;
      return view("employers.show", compact('employer', 'jobs'));
    }

/* //====================
  //== EDIT
 //==================== */
    public function edit(Employer $employer)
    {
      return view("employers.edit", compact('employer'));
    }

/* //====================
  //== STATUS UPDATE
 //==================== */
    public function statusUpdate(Employer $employer)
    {
        $employer->activate();

        return back()->with(flash_message('is-success', 'The status of the selected employer has been updated to active.'));
    }

/* //====================
  //== UPDATE
 //==================== */
    public function update(Request $request, Employer $employer)
    {
      $this->validate(request(), [
          'name' => 'required|min:3|max:55|unique:employers,name,' . $employer->id,
          'email' => 'max:250',
          'phone' => 'max:20',
          'website' => 'max:255',
          'linkedin' => 'max:255',
        ], ['name.unique' => 'Your attempt to update this employer is rejected as the name already exists in the database!']);

      $employer->update($request->all());
      return redirect('employers')->with(flash_message('is-success', 'The update action was successfull!'));
    }

/* //====================
  //== DESTROY
 //==================== */
    public function destroy(Employer $employer)
    {
      if($employer->inUse())
      {
          //== ARCHIVE EMPLOYER & THE ASSOCIATED JOBS & THE ASSOCIATED INTERVIEWS
         //====================
        event(new ActionDeleteEmployerInUse($employer));
        return back()->with(flash_message('is-success', "Your last action has updated the status of employer [{$employer->name}] to be archived !"));
      }
      $employer->delete();
      return redirect('/employers')->with(flash_message('is-success', 'The selected employer has been deleted successfully.'));
    }

}
