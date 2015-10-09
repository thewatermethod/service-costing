
@extends('layouts.default')

@section('content')


	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<ul class="nav navbar-nav">
				<li><a href="{{URL::to('jobs')}}">View All Jobs</a></li>
				<li><a href="{{URL::to('jobs/create')}}">Start a New Estimate</a></li>

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li id="filter-label">Filter Jobs: </li>
				<li><a href="{{URL::to('leads')}}">Leads</a></li>
				<li><a href="{{URL::to('estimated')}}">Estimated</a></li>
				<li><a href="{{URL::to('accepted')}}">To Be Scheduled</a></li>
				<li><a href="{{URL::to('scheduled')}}">Scheduled</a></li>
				<li><a href="{{URL::to('paid')}}">Completed</a></li>
	      	</ul>
		</div>
	</nav>
	
	<div class="panel panel-default">

 	  	<table class="table">
	  		
	  		<tr>
	  			<th>Job</th>
				<th>Customer Name</th>
				<th>Job Status</th>
				<th></th>
				<th></th>
			</tr>


		@foreach ( $jobs as $job )
			<tr>
				<td><a href="{{URL::to('jobs/'.$job->id)}}">{{ $job->address }}</a></td>
				<td>
					<a href="{{URL::to('customers/'.$customers->find( $job->customer_id )->id)}}">{{ $customers->find( $job->customer_id )->name }}</a>
				</td>
				<td>{{ $job->status }}</td>
				<td><a class="btn btn-success" href="{{URL::to('jobs/' . $job->id .'/edit')}}">EDIT</a></td>
				<td><button type="button" class="btn btn-warning " data-toggle="modal" data-target="#deleteJob{{$job->id}}">Delete</button></td>
			</tr>


			<div class="modal fade" id="deleteJob{{$job->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteJob{{$job->id}}Label">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">Are you sure?</div>
						<div class="modal-body">
							<button type="button" class="btn btn-default" data-dismiss="modal">Nevermind</button>
							{{ Form::open(array('url' => 'jobs/' . $job->id, 'class' => 'pull-right')) }}
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