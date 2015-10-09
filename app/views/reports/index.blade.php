@extends('layouts.default')

@section('content')

	<ul class="list-group">
		<li class="list-group-item"><h4 class="list-group-item-heading">Reports by Month</h4></li>
		<li class="list-group-item"><a href="{{URL::to('reports/date/2015/04')}}">April 2015</a></li>
		<li class="list-group-item"><a href="{{URL::to('reports/date/2015/05')}}">May 2015</a></li>
		<li class="list-group-item"><a href="{{URL::to('reports/date/2015/06')}}">June 2015</a></li>
	</ul>

	
	<ul class="list-group">
		<li class="list-group-item"><h4 class="list-group-item-heading">Reports by Lead Source</h4></li>

		@foreach ($advertisements as $advertisement)
			<li class="list-group-item">
				<a href="{{URL::to('reports/'.$advertisement->id)}}">{{$advertisement->name}}</a>
			</li>
		@endforeach

	</ul>

@stop