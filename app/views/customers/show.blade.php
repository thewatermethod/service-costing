
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

	<div class="panel panel-default">
  		<div class="panel-heading">
    		<h3 class="panel-title">{{$customer->name}}</h3>
    	</div>

    	<div class="panel-body">

			<p>Address: {{$customer->address}}</p>
			<p>Town: {{$customer->town}}</p>
			<p>Phone: {{$customer->phone}}</p>
			<p>E-mail: {{$customer->email}}</p>
			

			<h4>Jobs</h4>
	
				@foreach($jobs as $job)
					@if( $job->customer_id === $customer->id )
						<p><a href="{{URL::to('jobs/' . $job->id)}}">{{ $job->address }}</a> - {{$job->status}} - {{ $advertisements->find( $job->advertiser_id )->name }}</p>
					@endif
				@endforeach

	
		<a class="btn btn-success pull-left" href="{{URL::to('customers/'.$customer->id.'/edit')}}">EDIT</a>

		<button type="button" class="btn btn-warning button-small-top-margin pull-right" data-toggle="modal" data-target="#deleteCustomer{{$customer->id}}">Delete</button>
	
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

		</div>

	</div>

@stop