
@extends('layouts.default')

@section('content')

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				<li><a href="{{URL::to('customers')}}">View All Customers</a></li>
				<li><a href="{{URL::to('customers/create')}}">Create a New Customer</a></li>
			</ul>
			
		</div>
	</nav>	


	<h1>Add New Customer</h1>

	<div>

		{{ Form::open([ 'route' => 'customers.store' ]) }}

			<div class="form-group">
				{{ Form::label('name', 'Customer Name: ') }}
				{{ Form::text('name', null, array('class'=>'form-control')) }}
			</div>
			
			<div class="form-group">
				{{ Form::label('phone', 'Phone: ') }}
				{{ Form::text('phone', null, array('class'=>'form-control')) }}
			</div>

			<div class="form-group">
				{{ Form::label('address', 'Street Address: ') }}
				{{ Form::text('address', null, array('class'=>'form-control')) }}
			</div>

			<div class="form-group">
				{{ Form::label('town', 'Town: ') }}
				{{ Form::text('town', null, array('class'=>'form-control')) }}
			</div>

			<div class="form-group">
				{{ Form::label('email', 'Email: ') }}
				{{ Form::text('email', null, array('class'=>'form-control')) }}
			</div>

			{{ Form::submit('Create Customer', array( 'class'=>'btn btn-success')) }}

		{{ Form::close() }}

	</div>

@stop