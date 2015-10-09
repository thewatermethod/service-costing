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


	<h1>Edit Customer</h1>

	{{ HTML::ul($errors->all()) }}
	
	{{ Form::model( $customer, array('route' => array('customers.update', $customer->id), 'method' => 'PUT' ) ) }}
			<div class="form-group">
				{{ Form::label( 'name', 'Customer Name: ' ) }}
				{{ Form::text( 'name', null, array('class'=>'form-control') ) }}
			</div>
			
			<div class="form-group">
				{{ Form::label('phone', 'Phone: ')}}
				{{ Form::text( 'phone', null, array('class'=>'form-control') ) }}
			</div>			

			<div class="form-group">
				{{ Form::label('email', 'Email: ')}}
				{{ Form::text( 'email', null, array('class'=>'form-control') ) }}
			</div>

			<div class="form-group">
				{{ Form::label('address', 'Address: ')}}
				{{ Form::text( 'address', null, array('class'=>'form-control') ) }}
			</div>

			<div class="form-group">
				{{ Form::label('town', 'Town: ')}}
				{{ Form::text( 'town', null, array('class'=>'form-control') ) }}
			</div>

		
			<div>{{ Form::submit('Save Customer', array('class'=>'btn btn-success')) }}</div>

	{{ Form::close() }}	

	<button type="button" class="btn btn-warning button-small-top-margin" data-toggle="modal" data-target="#deleteCustomer{{$customer->id}}">Delete</button>

	<div class="modal fade" id="deleteCustomer{{$customer->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteCustomer{{$customer->id}}Label">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">Are you sure?</div>
				<div class="modal-body">
					<button type="button" class="btn btn-default" data-dismiss="modal">Nevermind</button>
					{{ Form::open(array('url' => 'customers/' . $customer->id, 'class' => 'pull-right')) }}
                   		{{ Form::hidden('_method', 'DELETE') }}
                   		{{ Form::submit('Yes, delete', array('class' => 'btn btn-warning')) }}
            		{{ Form::close() }}
            	</div>
            </div>
        </div>
	</div>



         

@stop