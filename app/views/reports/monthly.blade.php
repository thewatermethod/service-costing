@extends('layouts.default')

@section('content')
	
	<h2>Report for {{ $month }}/{{ $year }}</h2>

	<table class="table monthly-report-table">

		<tr>
			<th>Lead Source</th>
			<th>Monthly Cost</th>
			<th>Number of Leads</th>
			<th>Cost/Lead</th>
			<th>Total Conversions</th>
			<th>Cost/Conversion</th>
			<th>Billed Totals</th>
			<th>Labor Totals</th>
			<th>Material Totals</th>
			<th>Total Costs</th>
			<th>Profit</th>
		</tr>

		@foreach( $advertisements as $advertisement)
			@if( isset($active[$advertisement->id]) )
				<tr>
					<td class="report-table-name-label">{{ $advertisement->name }}</td>
					<td>${{ $advertisement->monthly_cost }}</td>
					<td>{{ $adarr[$advertisement->id] }}</td>
					@if ($adarr[$advertisement->id] > 0)	
						<td>${{ ( $advertisement->monthly_cost/$adarr[$advertisement->id]) }}</td>
					@else
						<td> - </td>
					@endif
					
					<td>{{ $statarr[$advertisement->id] }}</td>

					@if ($statarr[$advertisement->id] > 0)				
						<td>${{ ( $advertisement->monthly_cost/$statarr[$advertisement->id]) }}</td>
					@else
						<td> - </td>
					@endif

					<td>${{ $billedarr[$advertisement->id] }}</td>
					<td>${{ $laborarr[$advertisement->id] }}</td>
					<td>${{ $materialarr[$advertisement->id] }}</td>
					<td>${{ $advertisement->monthly_cost+$laborarr[$advertisement->id]+$materialarr[$advertisement->id] }}</td>
					<td>${{ $billedarr[$advertisement->id] - ( $advertisement->monthly_cost+$laborarr[$advertisement->id]+$materialarr[$advertisement->id] )}}</td>
				</tr>
			@endif
		@endforeach

			<tr class="info" style='font-weight: bold;'>
				<th>TOTALS</th>
				<td>${{$totalCost}}</td>
				<td>{{$totalNumberOfLeads}}</td>
				
				@if ($totalNumberOfLeads > 0)				
					<td>{{ '$'.round(( $totalCost/$totalNumberOfLeads),2); }}</td>
				@else
					<td> - </td>
				@endif
				
				<td>{{ $totalConv }}</td>

				@if ($totalConv > 0)				
					<td>{{ '$'.round(($totalCost/$totalConv),2); }}</td>
				@else
					<td> - </td>
				@endif
				<td>${{ $totalBilled }}</td>
				<td>${{ $totalLabor }}</td>
				<td>${{ $totalMaterial }}</td>
				<td style="color: red;">${{ ($totalLabor+$totalMaterial+$totalCost) }} </td>
				<td style="color: green;">${{ $totalBilled - ($totalLabor+$totalMaterial+$totalCost) }}</td>
			</tr>



	</table>
	

@stop