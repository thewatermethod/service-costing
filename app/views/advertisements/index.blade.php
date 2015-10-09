
@extends('layouts.default')

@section('content')
	
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				<li><a href="{{URL::to('advertisements')}}">View All Advertisements</a></li>
				<li><a href="{{URL::to('advertisements/create')}}">Create a New Advertisement</a></li>
			</ul>
			
		</div>
	</nav>


	<div class="panel panel-default">
 
	 	<div class="panel-heading">Advertisements</div>

		  	<table class="table">
		  		
		  		<tr>
					<th>Name</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Monthly Cost</th>
					<th></th>
				</tr>

				@foreach ($advertisements as $advertisement)
					
					<tr>
						<td><a href="{{URL::to('advertisements/'. $advertisement->id .'/')}}">{{ $advertisement->name }}</a></td>
					
						@if ($advertisement->start_date === '0' )						
							<td>Recurring</td>
						@else
							<td>{{$advertisement->start_date }}</td>
						@endif

						@if ( $advertisement->end_date === '0' )						
							<td> - </td>
						@else
							<td>{{ $advertisement->end_date }}</td>
						@endif
						
						<td>${{$advertisement->monthly_cost}}</td>
						<td>
							<a class="btn btn-success" href="{{URL::to('advertisements/' . $advertisement->id .'/edit')}}">EDIT</a>
						</td>
						<td><button type="button" class="btn btn-warning " data-toggle="modal" data-target="#deleteAd{{$advertisement->id}}">Delete</button></td>

					</tr>

					<div class="modal fade" id="deleteAd{{$advertisement->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteAd{{$advertisement->id}}Label">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">Are you sure?</div>
								<div class="modal-body">
									<button type="button" class="btn btn-default" data-dismiss="modal">Nevermind</button>
									{{ Form::open(array('url' => 'advertisements/' . $advertisement->id, 'class' => 'pull-right')) }}
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