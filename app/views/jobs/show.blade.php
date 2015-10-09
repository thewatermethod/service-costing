
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
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class='panel-title'> {{ $job->address }}</a>
		</div>
		<div class="panel-body">
			<table class="table">
				<tr>
					<td>Customer</td>
					<td><a href="{{URL::to('customers/'.$job->customer_id)}}">{{ $customers->find( $job->customer_id )->name }}</a></td>
				</tr>
				<tr>
					<td>Town</td>
					<td>{{$job->town}}</td>	
				</tr>
				<tr>
					<td>Job Status</td>
					<td>{{$job->status}}</td>
				</tr>
				<tr>
					<td>Source</td>
					<td>{{ $advertisements->find( $job->advertiser_id )->name }}</td>
				</tr>
				<tr>
					<td>Area of Cleaning</td>
					<td>{{$job->area_of_cleaning}}</td>
				</tr>
				<tr>
					<td>Date Estimate Requested</td>
					<td>{{$job->date_estimate_requested}}</td>
				</tr>
				<tr>
					<td>Date of Estimate</td>
					<td>{{$job->date_of_estimate}}</td>
				</tr>
				<tr>
					<td>Estimate Total</td>
					<td>{{$job->estimate_total}}</td>
				</tr>
				<tr>
					<td>Cost of Labor</td>
					<td>{{$job->cost_of_labor}}</td>
				</tr>
				<tr>
					<td>Cost of Material</td>
					<td>{{$job->cost_of_materials}}</td>
				</tr>
				<tr>
					<td>Total Invoiced</td>
					<td>{{$job->total_invoiced}}</td>
				</tr>
				<tr>
					<td>Invoice Number</td>
					<td>{{$job->invoice_number}}</td>
				</tr>
				<tr>
					<td>Date Paid</td>
					<td>{{$job->date_paid}}</td>
				</tr>
			</table>			
			
			<a class="btn btn-success pull-left" href="{{URL::to('jobs/' . $job->id .'/edit')}}">EDIT</a>
			<button type="button" class="btn btn-warning button-small-top-margin pull-right" data-toggle="modal" data-target="#deleteJob{{$job->id}}">Delete</button>
	
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

		</div>
	</div>


@stop