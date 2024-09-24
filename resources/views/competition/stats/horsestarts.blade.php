
<style type="text/css">
    table, th, td {
        border: solid 1px;
    }
</style>
	<table>
		
		<thead>
			<tr>
			<th>Lovas</th>	
			<th>Ló</th>
			<th>Versenyszám</th>
			</tr>
		</thead>

	
	<tbody>
@foreach ($results as $result)

	<tr>
		<td>{{$result->rider_name}} ( {{$result->rider_id}} )</td>
		<td>{{$result->horse_name}} ( {{$result->horse_id}} )</td>
		<td>{{$result->event_name}}</td>


	</tr>

@endforeach
</tbody>
</table>