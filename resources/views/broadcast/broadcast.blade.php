<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style type="text/css">
      h1{
        font-size: 3em;
      }
      h2{
        font-size: 2em;
      }
      body  { 
        background-color:#00b140;
        background-size: cover;
        color: white;
      }

      .ribbon {  
      background-color:  rgba(99,107,111,0.6);
      position: absolute;
      width: 80%;
      
              }

      #rider {
      bottom: 100px;
      left: 100px;

      
}
#event {
      top: 50px;
      left: -20px;
      width: auto;


}

#point {
      bottom: 32px;
      left: 150px;

}
#ep_logo {

      position: absolute;
      top: 140px;
      left: 33%;
}




        </style>
</head>
<body>
<div class="container">


<div class="rounded-pill  p-2" >
   <img src="/storage/logo/eprotokol_circle.png" width="600" height="600" id="ep_logo">
</div>


<div class="rounded-pill ribbon  p-2" id="event">
  
<h3 id="event" class="text-nowrap overflow-hidden pl-5 pr-5">{{$event->event_name}}</h1>
</div>

<div class="rounded-pill ribbon  p-2" id="rider">
  
<h1 id="name" class="text-nowrap overflow-hidden pl-5">{{$start->rider_name}} - {{$start->horse_name}} - {{$start->club}}</h1>
</div>

<div class="rounded-pill ribbon mb-2" id="point">
  
<h2 id="result" class="text-center pt-1  pb-2">-</h2>
</div>

</div>
</body>

  <script src="{{ asset('js/broadcastAjax.js') }}"></script>
</html>
