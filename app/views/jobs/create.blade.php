
@extends('layouts.default')

@section('content')


	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				<li><a href="{{URL::to('jobs')}}">View All Jobs</a></li>
				<li><a href="{{URL::to('jobs/create')}}">Start a New Estimate</a></li>

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{URL::to('leads')}}">Leads</a></li>
				<li><a href="{{URL::to('estimated')}}">Estimated</a></li>
				<li><a href="{{URL::to('accepted')}}">To Be Scheduled</a></li>
				<li><a href="{{URL::to('scheduled')}}">Scheduled</a></li>
				<li><a href="{{URL::to('paid')}}">Completed</a></li>
	      	</ul>
		</div>
	</nav>

	<h1 class="page-title">New Estimate Request</h1>

		{{ HTML::ul($errors->all()) }}
		{{ Form::open([ 'route' => 'jobs.store' ]) }}

			<div class="form-group">
				{{ Form::label( 'name', 'Existing Customer: ' ) }}
				{{ Form::select( 'name', $customerNames, array('class' => 'form-control') ) }}
			</div>

			<div class="form-group">
				<em>{{Form::label( 'newCustomer', 'New Customer?' )}}</em>
				{{Form::checkbox('newCustomer')}}
			</div>
			
			<div id="new-customer" class="container">
				<div class="form-group">
					{{ Form::label('newName', 'Customer Name: ') }}
					{{ Form::text('newName', null, array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::label('phone', 'Phone: ') }}
					{{ Form::text('phone', null, array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::label('address', 'Street Address: ') }}
					{{ Form::text('address', null, array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::label('town', 'Town: ') }}
					{{ Form::text('town', null, array('class' => 'form-control')) }}
				</div>

				<div class="form-group">
					{{ Form::label('email', 'Email: ') }}
					{{ Form::text('email', null, array('class' => 'form-control')) }}
				</div>
			</div>

			<div class="form-group">
				{{ Form::label('advertisement', 'Source of Lead: ') }}
				{{ Form::select( 'advertisement', $advertisements, array('class' => 'form-control') ) }}
			</div>

			<div class="form-group">
				{{ Form::label('job_address', 'Job Address (if different from customers): ')}}
				{{ Form::text( 'job_address', null, array('class' => 'form-control') ) }}
			</div>

			<div class="form-group">
				{{ Form::label('job_town', 'Job Town: ')}}
				{{ Form::text( 'job_town', null, array('class' => 'form-control') ) }}
			</div>

			<div class="form-group">
				{{Form::label('area_of_cleaning', "Area of Cleaning Requested: ")}}
				{{Form::textarea('area_of_cleaning', null, array('class' => 'form-control'))}}
			</div>

			{{ Form::submit('Create Job', array('class' => 'btn btn-success')) }}

		{{ Form::close() }}

	</div>
	<style>#new-customer{display: none;}</style>

@stop

@section('scripts')

	<script>
		$("input[type=checkbox]").on("click", function(){
			if ( $("input[type=checkbox]").prop("checked")) {
				$('#new-customer').slideDown();
			} else{
				$('#new-customer').slideUp();
			}
		});
	</script>

@stop