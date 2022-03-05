

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="{{ asset('js/displayRefresh.js') }}"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style type="text/css">
    h1 {
      @if (isset($nameSize))
  font-size: {{$nameSize}}vw;
    @else
    font-size: 6vw;
    @endif
}
  h4 {

  font-size: 3vw;
}
  </style>
</head>
<body>


<div class="container">
<h1 id="rider" class="text-nowrap" >{{$start->rider_name}}</h1>
<h1 id="horse" class=" text-nowrap" >{{$start->horse_name}}</h1>
<h1 id="club" class=" text-nowrap" >{{$start->club}}</h1>
<h4 id="result" class=" text-nowrap"> |
@foreach ($results as $result)
{{$result->position}}:{{$result->percent}} %| 
@endforeach
</h4>
</div>
</body>
</html>
