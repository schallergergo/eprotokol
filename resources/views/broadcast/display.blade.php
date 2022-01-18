

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="{{ asset('js/displayRefresh.js') }}"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<h1 class="display-1 text-nowrap" style="font-size:6vw;">{{$start->rider_name}}</h1>
<h1 class="display-1 text-nowrap" style="font-size:6vw;">{{$start->horse_name}}</h1>
<h1 class="display-1 text-nowrap" style="font-size:6vw;">{{$start->club}}</h1>
<h4 class="display-1 text-nowrap" style="font-size:4vw;"> |
@foreach ($results as $result)
<span>{{$result->position}}:{{$result->percent}} | </span>
@endforeach
</h4>
</div>
</body>
</html>
