<?php

namespace App\Http\Controllers;

use App\Http\Helper\Constant;
use App\Model\Country;
use App\Model\State;
use App\Model\City;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the nerds
        $city = City::with('getcountry')->paginate(10);
        // load the view and pass the nerds
        return view('admin.city.index', compact('city'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Constant::$status;
        $country = Country::whereIn('status', ['1', 1])->get();
        return View::make('admin.city.create', compact('status', 'country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'country' => 'required',
            'state' => 'required|unique:country|max:255',
            'status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('state/create')
                ->withErrors($validator)
                ->withInput(Input::except('country'));
        } else {
            // store
            $state = new State;
            $state->state = Input::get('state');
            $state->country = Input::get('country');
            $state->status = Input::get('status');
            $state->save();
            // redirect
            Session::flash('message', 'Successfully created state!');
            return Redirect::to('state');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the nerd
        $section = Section::find($id);

        // show the view and pass the nerd to it
        return View::make('admin.section.show')
            ->with('section', $section);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get the nerd

        $state = State::find($id);
        $country = Country::whereIn('status', ['1', 1])->get();
        $status = Constant::$status;
        return View::make('admin.state.edit', compact('status', 'country', 'state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rules = array(
            'country' => 'required',
            'state' => 'required|unique:country|max:255',
            'status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('state.edit', ['id' => $id]))
                ->withErrors($validator)
                ->withInput(Input::except('state'));
        } else {
            // store
            $state = State::where('_id', $id)->first();
            if (!empty($state)) {


                $state->country = Input::get('country');
                $state->state = Input::get('state');
                $state->status = Input::get('status');
                $state->save();
                // redirect
                Session::flash('message', 'Successfully updated state!');
                return Redirect::to('state');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::findOrFail($id);
        if (!empty($state)) {
            $state->delete();
        }
        Session::flash('message', 'State successfully deleted!');
        return Redirect::to('state');
    }
}
