

<h1>{{count($results)}} ember indult!!!!!!</h1>
<style type="text/css">
    table, th, td {
        border: solid 1px;
    }
</style>
	<table>
		
		<thead>
			<tr>
			<th>Ember száma</th>	
			<th>Ember neve</th>
			<th>Hányat megy szegény</th>
			</tr>
		</thead>

	
	<tbody>
@foreach ($results as $result)

	<tr>
		<td>{{$result->rider_id}}</td>
		<td><a href="{{route('competition.stats.rider',[$competition->id,$result->rider_id])}}">{{$result->rider_name}}</a></td>
		<td>{{$result->rider_count}}</td>


	</tr>

@endforeach
</tbody>
</table>