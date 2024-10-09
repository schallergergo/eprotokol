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

      #sponsor {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }
      .ribbon {  
      background-color:  rgba(99,107,111,0.95);
      position: absolute;
      width: 80%;
      
              }

      #rider {
      bottom: 100px;
      left: 100px;

      
}

#logo {
      position: absolute;
      top: 20px;
      left: 20px;
      width: auto;
      }
#event {
      top: 45px;
      left: 120px;
      width: auto;


}

#point {
      bottom: 28px;
      left: 150px;

}

        </style>
</head>
<body>
  <input type="hidden" id="competition_id" value="{{$competition->id}}">
<div class="container">
  <div id="logo">
  <img src="https://eprotokol.hu/storage/logo/logo_circle.png" width="100" height="100">

</div>
<div class="rounded-pill ribbon  p-2" id="event">

<h2 id="event" class="text-nowrap overflow-hidden pl-5 pr-5"></h2>
</div>

  <div id="sponsor">
    
    <img src="" width="500px">

  </div>

<div class="rounded-pill ribbon  p-2" id="rider">
  
<h1 id="name" class="text-nowrap overflow-hidden pl-5"></h1>
</div>

<div class="rounded-pill ribbon mb-2" id="point">
  
<h2 id="result" class="text-center pt-2  pb-2">-</h2>
</div>

</div>
</body>

  <script src="{{ asset('js/broadcastAjaxCompetition.js') }}"></script>
</html>
