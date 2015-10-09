
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
		<div class="panel-heading">{{ $advertisement->name }}  - {{$advertisement->code}}</div>

		<div class='panel-body'>
			<p>Monthly Cost: {{ $advertisement->monthly_cost }}</p>
			
			@if ($advertisement->is_recurring)
				<p><em>Recurring</em></p>
			@else
				<p>Start Date:   {{$advertisement->start_date}}</p>
				<p>End Date:     {{$advertisement->end_date}}</p>
			@endif

			<a class="btn btn-success" href="{{URL::to('advertisements/' . $advertisement->id .'/edit')}}">EDIT</a>
			<button type="button" class="btn btn-warning " data-toggle="modal" data-target="#deleteAd{{$advertisement->id}}">Delete</button>

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



		</div>
	</div>

@stop