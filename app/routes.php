<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function()
{
	if( Auth::check()){
		return View::make('index');
	}else{
		return Redirect::to('login');
	}

	
});

Route::resource('customers', 'CustomersController');
Route::resource('jobs', 'JobsController');
Route::resource('advertisements','AdvertisementsController');

Route::get('login', 'HomeController@showLogin');
Route::post('login', 'HomeController@doLogin');

Route::get('leads', 'JobsController@showLeads' );
Route::get('estimated', 'JobsController@showEstimated' );
Route::get('accepted', 'JobsController@showAccepted' );
Route::get('scheduled', 'JobsController@showScheduled' );
Route::get('paid', 'JobsController@showPaid' );

Route::get('reports', 'ReportsController@index');
Route::get('reports/date/{year}/{month}', 'ReportsController@showReportByDate');
Route::get('reports/{id}','ReportsController@showReportByAdvertiser');