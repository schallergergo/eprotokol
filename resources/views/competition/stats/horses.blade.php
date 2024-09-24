

<h1>{{count($results)}} ló indult!!!!!!</h1>
<style type="text/css">
    table, th, td {
        border: solid 1px;
    }
</style>
	<table>
		
		<thead>
			<tr>
			<th>Lovacska száma</th>	
			<th>Lovacska neve</th>
			<th>Hányat megy szegény</th>
			</tr>
		</thead>

	
	<tbody>
@foreach ($results as $result)

	<tr>
		<td>{{$result->horse_id}}</td>
		<td><a href="{{route('competition.stats.horse',[$competition->id,$result->horse_id])}}">{{$result->horse_name}}</a></td>
		<td>{{$result->horse_count}}</td>


	</tr>

@endforeach
</tbody>
</table>