<?php

class AdvertisementsController extends BaseController {

	public function index(){
		if ( is_null(Auth::user()) || Auth::user()->access != '1'){
			
			return View::make('users.access');

		} else {

			$advertisements = Advertisement::all();
			return View::make('advertisements.index', ['advertisements' => $advertisements]);
		}
	}

	public function show($id){

		if (Auth::user()->access != '1'){
			
			return View::make('users.access');

		} else {

			$customers = Customer::all();
			$jobs = Job::all();
			$advertisement = Advertisement::find($id);
			return View::make('advertisements.show', ['customers' => $customers], ['jobs' => $jobs])->with('advertisement', $advertisement);

		}
	}

	public function create(){

		return View::make( 'advertisements.create');
	}

	public function destroy($id){

		$advertisement = Advertisement::find($id);
		$advertisement->delete();

		return Redirect::to('advertisements');

	}

	public function store(){
		if (Auth::user()->access != '1'){
			
			return View::make('users.access');

		} else {

			$rules = array(
				'monthly_cost'	=> 'required',
				'code' 			=> 'required'
			);
			

			$validator = Validator::make(Input::all(), $rules );

			if( $validator->fails() ){
				return Redirect::to('advertisements/create')
					->withErrors($validator);
			} else {
				$advertisement = new Advertisement;
				$advertisement->name = Input::get('name');
				$advertisement->monthly_cost = Input::get('monthly_cost');
				$advertisement->code = Input::get('code');


				if( Input::get('is_recurring') ){
					$advertisement->start_date = 0;
					$advertisement->end_date = 0;
				} else {
					$advertisement->start_date = Input::get('start_date');
					$advertisement->end_date = Input::get('end_date');
				}

				$advertisement->save();

				return Redirect::route('advertisements.index');

			}
		}
			
	}

	public function edit($id){
		$advertisement = Advertisement::find($id);
		return View::make('advertisements.edit')->with('advertisement', $advertisement);
	}

	public function update($id){
	
		if (Auth::user()->access != '1'){
			
			return View::make('users.access');

		} else {

			$rules = array(
				'monthly_cost'	=> 'required',
				'code' 			=> 'required'
			);
			

			$validator = Validator::make(Input::all(), $rules );

			if( $validator->fails() ){
				return Redirect::to('advertisements/' . $id . '/edit')
					->withErrors($validator);
			} else {


				$advertisement = Advertisement::find($id);
				$advertisement->name = Input::get('name');
				$advertisement->monthly_cost = Input::get('monthly_cost');
				$advertisement->code = Input::get('code');

				$advertisement->is_recurring = Input::get('is_recurring');

				if( Input::get('is_recurring') ){
					$advertisement->start_date = 0;
					$advertisement->end_date = 0;
				} else {
					$advertisement->start_date = Input::get('start_date');
					$advertisement->end_date = Input::get('end_date');
				}


				$advertisement->save();

				return Redirect::route('advertisements.index');

			}
		}
				
	}

}
