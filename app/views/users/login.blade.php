
@extends('layouts.default')

@section('content')
	
	<h2>Please log in!</h2>

	<div class="bs-callout bs-callout-danger">
		{{ $errors->first('email')}}
		{{ $errors->first('password')}}
	</div>

	<div class="row">
		<div class="container">
			<div class="col-md-6 col-xs-12">
				{{ Form::open( array('url'=>'login' ) ) }}

					<div class="form-group">
						{{ Form::label('email', 'E-Mail: ') }}
						{{ Form::text('email', null, array('class'=>'form-control')) }}
					</div>

					<div class="form-group">
						{{ Form::label('password', 'Password: ') }}
						{{ Form::password('password', array('class'=>'form-control')) }}
					</div>

					{{ Form::submit('Log in', array( 'class'=>'btn btn-success')) }}

				{{ Form::close() }}
			</div>
		</div>
	</div>
@stop