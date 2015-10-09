@extends('layouts.default')

@section('content')
	
	<h2>Report for {{ $advertisement->name }}</h2>

	<table class="table">

		<tr>
			<th>Cost</th>
			<th>Number of Leads</th>
			<th>Cost/Lead</th>
			<th>Cost/Conversion</th>
			<th>Billed Totals</th>
			<th>Labor Totals</th>
			<th>Material Totals</th>
			<th>Total Costs</th>
			<th>Profit</th>
		</tr>

		
			<tr>
				
				<td>{{ $advertisement->monthly_cost }}</td>
				<td>{{ $leads }}</td>
				@if ( $leads > 0)	
					<td>{{ ( $advertisement->monthly_cost/$leads ) }}</td>
				@else
					<td> - </td>
				@endif
				
				@if ($convs > 0)				
					<td>{{ ( $advertisement->monthly_cost/$convs) }}</td>
				@else
					<td> - </td>
				@endif

				<td>{{ $billed }}</td>
				<td>{{ $labor}}</td>
				<td>{{ $material }}</td>
				<td>{{ $advertisement->monthly_cost+$labor+$material }}</td>
				<td>{{ $billed - ( $advertisement->monthly_cost+$labor+$material )}}</td>
			</tr>
	
	</table>
	

@stop