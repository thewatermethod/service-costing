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


	<h1>Edit Advertising</h1>

	<div class="container">
	{{ HTML::ul($errors->all()) }}
	
	{{ Form::model( $advertisement, array('route' => 
		array('advertisements.update', 
			$advertisement->id), 'method' => 'PUT' )) }}		

			<div class="form-group">
				{{Form::label( 'name', 'Name: ' )}}
				{{Form::text('name', null, array('class' => 'form-control'))}}
			</div>

			<div class="row">

				<div class="col-md-6">

					<div class="form-group">
						{{Form::label( 'code', 'Advertising Code: ' )}}
						{{Form::text('code', null, array('class' => 'form-control'))}}
					</div>

				</div>

				<div class="col-md-6">

					<div class="form-group">
						{{Form::label( 'monthly_cost', 'Monthly Cost: ' )}}
						{{Form::text('monthly_cost', null, array('class' => 'form-control'))}}
					</div>

				</div>

			</div>
			
			<div class="form-group">
				{{Form::label( 'is_recurring', 'Is Recurring: ' )}}
				{{Form::checkbox('is_recurring', 1)}}
			</div>

			<div class="row" id="dates">

				<div class="col-md-6">

					<div class="form-group">
						{{Form::label( 'start_date', 'Start Date: ' )}}
						{{Form::input('date', 'start_date', null, array('class' => 'form-control'))}}
					</div>

				</div>

				<div class="col-md-6">

					<div class="form-group">
						{{Form::label( 'end_date', 'End Date: ' )}}
						{{Form::input('date', 'end_date', null, array('class' => 'form-control'))}}
					</div>

				</div>

			</div>		

			<div>{{ Form::submit('Save Advertisement', array('class'=>"btn btn-success")) }}</div>

	{{ Form::close() }}	


		<button type="button" class="btn btn-warning button-small-top-margin" data-toggle="modal" data-target="#deleteAd{{$advertisement->id}}">Delete</button>

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

	<style>#dates{display: none;}</style>
@stop


@section('scripts')

	<script>
		$("input[type=checkbox]").on("click", function(){
			if ( $("input[type=checkbox]").prop("checked")) {
				$('#dates').slideUp();
			} else{
				$('#dates').slideDown();
			}
		});
	</script>

@stop