

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="{{ asset('js/displayRefresh.js') }}"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  </style>
</head>
<body>


<div class="container">
<h1 id="rider" class="text-nowrap {{$nameSize}}" >{{$start->rider_name}}</h1>
<h1 id="horse" class=" text-nowrap {{$nameSize}}" >{{$start->horse_name}}</h1>
<h1 id="club" class=" text-nowrap {{$nameSize}}" >{{$start->club}}</h1>
<h4 id="result" class=" text-nowrap {{$pointSize}}"> |
@foreach ($results as $result)
{{$result->position}}:{{$result->percent}} %| 
@endforeach
</h4>
</div>
</body>
</html>
