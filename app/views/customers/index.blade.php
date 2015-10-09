
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
 
	 	<div class="panel-heading">Customers <em><a style="float:right;" href="{{URL::to('customers/create')}}">Create New Customer</a></em></div>

		  	<table class="table">
		  		
		  		<tr>
					<th>Name</th>
					<th></th>
				</tr>

				@foreach ($customers as $customer)
					<tr>
						<td><a href="{{URL::to('customers/'. $customer->id .'/')}}">{{ $customer->name }}</a></td>
						<td><a class="btn btn-success" href="{{URL::to('customers/' . $customer->id .'/edit')}}">Edit</a></td>
						<td><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#deleteCustomer{{$customer->id}}">Delete</button>

					</tr>

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

				@endforeach

			

			
			</table>

		</div>

	</div>


@stop

@section('scripts')
	
	<script>
		$('button[data-target="deleteCustomer2"]').click( function(){
			console.log('Clicked');
		});
	</script>
	
@stop