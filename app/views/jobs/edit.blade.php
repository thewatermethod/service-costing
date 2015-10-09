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


	{{ HTML::ul($errors->all()) }}
	
	{{ Form::model( $job, array('route' => array('jobs.update', $job->id), 'method' => 'PUT' ) ) }}
			<div class="form-group">
				{{ Form::label( 'name', 'Customer Name: ' ) }}
				{{ Form::select( 'name', $customers, $job->customer_id, array('class' => 'form-control')) }}
			</div>
			
			<div class="form-group">
				{{ Form::label('advertisement', 'Source of Lead: ')}}
				{{ Form::select( 'advertisement', $advertisements, $job->advertiser_id, array('class' => 'form-control') ) }}
			</div>

			<div class="form-group">
				{{ Form::label('address', 'Job Address: ')}}
				{{ Form::text( 'address', null, array('class' => 'form-control') ) }}
			</div>

			<div class="form-group">
				{{ Form::label('town', 'Town: ')}}
				{{ Form::text( 'town', null, array('class' => 'form-control') ) }}
			</div>

			<div class="form-group">
					{{Form::label('area_of_cleaning', "Area of Cleaning Requested: ")}}
					{{Form::textarea('area_of_cleaning', null, array('class' => 'form-control'))}}
			</div>

			<div class="form-group">
				{{Form::label('status', 'Status: ')}}
				{{Form::select( 'status', [
					'lead' 				=> 'Lead',
					'estimated' 		=> 'Estimated',
					'accepted' 			=> 'Accepted', 
					'scheduled'		   	=> 'Scheduled',
					'paid'		 		=> 'Paid',
					'business_lost' 	=> 'Business Lost'],
					$job->status, array('class' => 'form-control')  )}}
			</div>

			<div class="form-group">
				{{Form::label('date_estimate_requested', 'Date Estimate Requested: ')}}
				{{Form::text( 'date_estimate_requested', null, array('class' => 'form-control') )}}
			</div>

			<div class="form-group">
				{{Form::label('date_of_estimate', 'Date of Estimate: ')}}
				{{Form::text( 'date_of_estimate', null, array('class' => 'form-control') )}}
			</div>

			<div class="form-group">
				{{ Form::label('invoiced', 'Total Invoiced: ')}}
				{{ Form::text( 'invoiced', $job->total_invoiced, array('class' => 'form-control') ) }}
			</div>

			<div class="form-group">
				{{Form::label('cost_of_labor', 'Cost of Labor: ')}}
				{{Form::text( 'cost_of_labor', null, array('class' => 'form-control') )}}
			</div>

			<div class="form-group">
				{{Form::label('cost_of_materials', 'Cost of Materials: ')}}
				{{Form::text( 'cost_of_materials', null, array('class' => 'form-control') )}}
			</div>

			{{ Form::submit('Save Job', array('class'=>'btn btn-success')) }}

	{{ Form::close() }}	

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


@stop