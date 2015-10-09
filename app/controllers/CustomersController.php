<?php

class CustomersController extends BaseController {

	public function index(){
		$customers = Customer::all();
		return View::make('customers.index', ['customers' => $customers]);
	}

	public function create(){
		return View::make('customers.create');
	}

	public function store(){
	
		$customer = new Customer;
		$customer->name = Input::get('name');
		$customer->phone = Input::get('phone');
		$customer->address = Input::get('address');
		$customer->town = Input::get('town');
		$customer->email = Input::get('email');

		$customer->save();

		return Redirect::route('customers.index');
	}

	public function show($id){

		$customer = Customer::find($id);
		$jobs = Job::all();
		$advertisements = Advertisement::all();

		return View::make('customers.show', ['jobs' => $jobs, 'advertisements' => $advertisements])->with('customer', $customer);
	}

	public function edit($id){
		$customer = Customer::find($id);
		$advertisements = Advertisement::all();
		$jobs = Job::all();
		return View::make('customers.edit')->with('customer', $customer);
	}


	public function destroy($id){

		$customer = Customer::find($id);
		$customer->delete();

		$jobs = Job::all();

		if ( count($jobs) > 0 ){		
			foreach( $job as $jobs ){
				if ($job->customer_id === $id){
					$job->delete();
				}
			}
		}

		return Redirect::to('customers');
	}

	public function update($id){

		$rules = array(
			'address'	=> 'required',
			'name' 		=> 'required',
			'phone'		=> 'required'
		);
		

		$validator = Validator::make(Input::all(), $rules );

		if( $validator->fails() ){
			return Redirect::to('customers/' . $id . '/edit')
				->withErrors($validator);
		} else {

			$customer = Customer::find($id);
			$customer->name = Input::get('name');
			$customer->phone = Input::get('phone');
			$customer->email = Input::get('email');
			$customer->address = Input::get('address');
			$customer->town = Input::get('town');

			$customer->save();

			Session::flash('message', 'Customer updated.');
			return Redirect::to('customers');
		}
	}
}
