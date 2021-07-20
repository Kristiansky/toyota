<?php

namespace App\Http\Controllers;

use App\Record;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    
    public $web_forms_options = ['contact', 'test_drive', 'car_configurator', 'tbglc_leasing', 'tdio_test_drive', 'tdio_offer', 'tdio_brochure', 'contact_request', 'used_car', 'test_drive_appointment_request', 'online_reservation'];
    public $cars_options = ['aygo', 'yaris', 'corolla_hatchback', 'corolla_touring_sports', 'corolla_sedan', 'camry', 'yaris_cross', 'c-hr', 'rav4', 'highlander', 'land_cruiser', 'hilux', 'proace', 'proace_verso', 'proace_city', 'proace_city_verso', 'other'];
    public $contact_validation_options = ['call', 'email', 'not_validated'];
    public $status_options = ['new', 'reminded', 'late', 'accepted', 'in_process', 'completed'];
    public $status_options_fill = ['accepted', 'in_process', 'completed'];
    public $dealer_info_options = ['order', 'test_drive_success', 'test_drive_set', 'will_visit_showroom', 'sent_offer', 'sent_borchure', 'sent_leasing_sim', 'second_hand', 'not_serious_interest', 'waiting', 'gave_up', 'no_feedback', 'wrong_contact'];
    public $dealer_progress_status_options = ['client', 'hot', 'warm', 'cold', 'lost'];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole(['administrator', 'manager'])){
            $records = Record::orderBy('id', 'desc')->paginate(10);
        }elseif(auth()->user()->hasRole(['dealer'])){
            $records = Record::orderBy('id', 'desc')->where('dealer_id', '=' , auth()->user()->id)->paginate(10);
        }
        return view('records.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $web_forms_options = $this->web_forms_options;
        $cars_options = $this->cars_options;
        $contact_validation_options = $this->contact_validation_options;
        $dealer_info_options = $this->dealer_info_options;
        $dealer_progress_status_options = $this->dealer_progress_status_options;
        $dealers = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'dealer');
        })->select('users.id as id', 'users.name as name', 'users.email as email')->get();
        return view('records.create', compact('web_forms_options','cars_options', 'contact_validation_options', 'dealers', 'dealer_info_options', 'dealer_progress_status_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = array(
            'user_id' => 'required',
            'dealer_id' => 'required',
        );
    
        $request->validate($validation);
        $inputs = $request->all();
        $inputs['status'] = 'new';
        Record::create($inputs);
    
        return redirect(route('records.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        return view('records.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        $web_forms_options = $this->web_forms_options;
        $cars_options = $this->cars_options;
        $contact_validation_options = $this->contact_validation_options;
        $dealer_info_options = $this->dealer_info_options;
        $dealer_progress_status_options = $this->dealer_progress_status_options;
        $status_options = $this->status_options;
        $dealers = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'dealer');
        })->select('users.id as id', 'users.name as name', 'users.email as email')->get();
        return view('records.edit', compact('record', 'web_forms_options', 'cars_options', 'contact_validation_options', 'dealers', 'dealer_info_options', 'dealer_progress_status_options', 'status_options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        $validation = array(
            'dealer_id' => 'required',
        );
    
        if(request('fillForm')){
            $validation = array(
                'status' => 'required',
            );
            unset($request['fillForm']);
        }
        
        $request->validate($validation);
        
        $record->update($request->all());
        session()->flash('message', 'Обаждането е редактирано');
    
        return redirect(route('records.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        $record->delete();
    
        session()->flash('message', 'Обаждането е изтрито');
    
        return back();
    }
    
    public function fill(Record $record){
        $status_options_fill = $this->status_options_fill;
        $dealer_info_options = $this->dealer_info_options;
        $dealer_progress_status_options = $this->dealer_progress_status_options;
        return view('records.fill', compact('record', 'status_options_fill', 'dealer_info_options', 'dealer_progress_status_options'));
    }
}
