<?php

class UsersController extends BaseController {

	public function login(){
		return View::make('users.login');

	}

	public function authenticate(){

		if (Auth::check()){

			return Redirect::to('/');

		} else {

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

				if ( Auth::attempt( array('email' => $email, 'password' => $password), true) ){
					return View::make('users.dashboard');
				} else {
					return View::make('users.login');
				}

			}

		} //closes auth check 	

	}// close function authenticate

} //close Users Controller

?>