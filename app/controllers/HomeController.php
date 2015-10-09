<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showLogin(){
	    // show the form
	    return View::make('users.login');
	}

	public function doLogin(){
	
				$rules = array(
					'email' => 'required|email',
					'password' => 'required'
				);

				$validator = Validator::make( Input::all(), $rules );

				if( $validator->fails() ){
				    return Redirect::to('login')
				        ->withErrors($validator)
				        ->withInput(Input::except('password')); 				
				} else{ 

					$email = Input::get('email');
					$password = Input::get('password');

					if ( Auth::attempt( array('email' => $email, 'password' => $password)) ){
						return View::make('index');
					} else {
						return View::make('users.login');
					}

				}
		}

}
