<?php

namespace App\Http\Controllers;
use App\Http\Helper\Constant;
use App\Model\Country;
use Illuminate\Http\Request;
use View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the nerds
        $country = Country::paginate(10);

        // load the view and pass the nerds
        return view('admin.country.index', compact('country'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Constant::$status;
        return View::make('admin.country.create',compact('status'));
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
            'country' => 'required|unique:country|max:255',
            'status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('country/create')
                ->withErrors($validator)
                ->withInput(Input::except('country'));
        } else {
            // store
            $country = new Country;
            $country->country = Input::get('country');
            $country->status = Input::get('status');
            $country->save();
            // redirect
            Session::flash('message', 'Successfully created country!');
            return Redirect::to('country');
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
        
        $country = Country::find($id);
        $status = Constant::$status;
        return View::make('admin.country.edit',compact('status','country'));
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
            'status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(route('country.edit', ['id' => $id]))
                ->withErrors($validator)
                ->withInput(Input::except('country'));
        } else {
            // store
            $country = Country::where('_id',$id)->first();
            if(!empty($country)){

                
                $country->country = Input::get('country');
                $country->status = Input::get('status');
                $country->save();
                // redirect
                Session::flash('message', 'Successfully updated country!');
                return Redirect::to('country');
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
        $country = Country::findOrFail($id);
        if(!empty($country))
        {
           $country->delete();
        }
        Session::flash('message', 'Country successfully deleted!');
        return Redirect::to('country');


    }
}
