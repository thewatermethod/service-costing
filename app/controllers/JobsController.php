<?php

class JobsController extends BaseController {

	public function index(){
		$customers = Customer::all();
		$jobs = Job::all();
		return View::make('jobs.index', ['jobs' => $jobs, 'customers' => $customers]);
	}

	public function showLeads(){
		$customers = Customer::all();
		$jobs = Job::where( 'status', '=', 'lead' )->get();
		return View::make('jobs.index', ['jobs' => $jobs, 'customers' => $customers]);
	}

	public function showEstimated(){
		$customers = Customer::all();
		$jobs = Job::where( 'status', '=', 'estimated' )->get();
		return View::make('jobs.index', ['jobs' => $jobs, 'customers' => $customers]);
	}

	public function showAccepted(){
		$customers = Customer::all();
		$jobs = Job::where( 'status', '=', 'accepted' )->get();
		return View::make('jobs.index', ['jobs' => $jobs, 'customers' => $customers]);
	}

	public function showScheduled(){
		$customers = Customer::all();
		$jobs = Job::where( 'status', '=', 'scheduled' )->get();
		return View::make('jobs.index', ['jobs' => $jobs, 'customers' => $customers]);
	}

	public function showPaid(){
		$customers = Customer::all();
		$jobs = Job::where( 'status', '=', 'paid' )->get();
		return View::make('jobs.index', ['jobs' => $jobs, 'customers' => $customers]);
	}

	public function show($id){
		$advertisements = Advertisement::all();
		$customers = Customer::all();
		$job = Job::find($id);
		return View::make('jobs.show', ['customers' => $customers], ['advertisements'=>$advertisements])->with('job', $job);
	}

	public function edit($id){
		$customers = Customer::lists('name','id');
		$advertisements = Advertisement::lists('name', 'id');
		$job = Job::find($id);
		return View::make('jobs.edit', ['advertisements' => $advertisements, 'customers' => $customers])->with('job', $job);
	}

	public function update($id){

		$rules = array(
			'address'	 		=> 'required',
			'town' 				=> 'required',
			'advertisement' 	=> 'required',
		
		);
		

		$validator = Validator::make(Input::all(), $rules );

		if( $validator->fails() ){
			return Redirect::to('jobs/' . $id . '/edit')
				->withErrors($validator);
		} else {

			$customer = Customer::find( Input::get('name') );
			$advertisement = Advertisement::find( Input::get('advertisement') ); 

			$job = Job::find($id);
			$job->customer_id = $customer->id;
			$job->advertiser_id = $advertisement->id;
			$job->address = Input::get('address');
			$job->town = Input::get('town');
			$job->area_of_cleaning = Input::get('area_of_cleaning');
			$job->status = Input::get('status');
			$job->date_of_estimate = Input::get('date_of_estimate');
			$job->cost_of_labor = Input::get('cost_of_labor');
			$job->cost_of_materials = Input::get('cost_of_materials');
			$job->total_invoiced = Input::get('invoiced');
			$job->date_estimate_requested = Input::get('date_estimate_requested');
		
			$job->save();

			Session::flash('message', 'Job updated.');
			return Redirect::to('jobs');
		}

	}

	public function create(){

		$customerNames = Customer::lists('name','id');
		$advertisements = Advertisement::lists('name', 'id');
		return View::make( 'jobs.create', ['customerNames' => $customerNames, 'advertisements' => $advertisements]);
	}

	public function destroy($id){

		$job = Job::find($id);
		$job->delete();

		return Redirect::to('jobs');

	}

	public function store(){

		$rules = array(
		);
		

		$validator = Validator::make(Input::all(), $rules );

		if( $validator->fails() ){
			return Redirect::to('jobs/create')
				->withErrors($validator);
		} else {

			$job = new Job;


			//check to see if new customer, if so save record to database
			if ( Input::get('newCustomer') == '1' ){

				$customer = new Customer;
				$customer->name = Input::get('newName');
				$customer->phone = Input::get('phone');
				$customer->address = Input::get('address');
				$customer->town = Input::get('town');
				$customer->email = Input::get('email');

				$customer->save();

		
			} else {

				$customer = Customer::find( Input::get('name') );		
				
				
			}
				$job->customer_id = $customer->id;
			

			//get the advertisement id
			$advertisementId = Input::get('advertisement');
			$advertisement = Advertisement::find( $advertisementId );	
			$job->advertiser_id = $advertisement->id;


			//get the job address if different from the customers
			if ( Input::get('job_address') ){

				$job->address = Input::get('address');
				$job->job_town = Input::get('town');

			} else{

				$job->address = $customer->address;
				$job->town = $customer->town;

			}

			$job->area_of_cleaning = Input::get('area_of_cleaning');

			//handle remaining data
			$job->date_estimate_requested = date('Ymd');
			$job->status = "lead";
			$job->save();

			return Redirect::route('jobs.index');

		}

	}

}