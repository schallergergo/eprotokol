
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style type="text/css">
    body{

      color: #636b6f;

        </style>
</head>
<body>


<div class="container">
  
<div class="d-flex justify-content-center pt-4" >
  <!--<img class="img-fluid max-width:20%"src="https://eprotokol.hu/storage/logo/logo_med.png">-->
    <h1 id="header_name" class=" d-flex justify-content-center text-nowrap display-3 font-weight-bold mt-3" >event</h1></div>
  
<h1 id="rider_name" class=" d-flex justify-content-center text-nowrap display-2 mt-3" >$start->rider_name</h1>
<h1 id="horse_name" class=" d-flex justify-content-center text-nowrap display-2 mt-3" >$start->horse_name</h1>
<h1 id="club_name" class="  d-flex justify-content-center text-nowrap display-2 mt-3" >$start->club</h1>
<h4 id="result" class=" d-flex justify-content-center text-nowrap display-2  mt-3">
  result
</h4>
</div>
</body>
<script src="{{ asset('js/displayAjaxFullScreen.js') }}"></script>
</html>
