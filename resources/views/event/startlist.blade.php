<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
		table, th, td {
		  border:1px solid black;
		  border-collapse: collapse;
		}
</style>
</head>
<body>
<p></p><a href="/event/show/{{$event->id}}"> Vissza- {{$event->event_name}}</a></p>
<table style="width:70%">
 <tr>
    <th>Lovas</th>
    <th>Ló</th>
    <th>Klub</th>
    <th>Mentési idő</th>
  </tr>


@foreach($starts as $start)
  <tr>
    <td>{{$start->rider_name}}</td>
    <td>{{$start->horse_name}}</td>
    <td>{{$start->club}}</td>
    <td>
    	@foreach($start->result as $result)
    	{{$result->updated_at}} <br>
    	@endforeach
    </td>
  </tr>

@endforeach
</table>
</body>
</html>