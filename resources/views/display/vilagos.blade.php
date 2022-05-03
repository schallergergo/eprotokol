<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style type="text/css">
    body{
      color: #636b6f;
    }
    .header{
      width: 120px;
      height: 60px;
    }
    .header img {
      float: left;
      padding: 5px;
      width: 120px;
      height: 50px;

  }
.line{
  width: 520px;
  height: 50px;

}

      h1{
        font-size: 2em;
        
      }
      h2{
        font-size: 1.5em;
        
      }
      h3{
        font-size: 1.25em;
        
      }
      h1, h2,h3{
        text-align: center;
      }

      #display{
        height: 280px;
        width: 520px;
        background-color:#dedede;


      }
      #rider {



}
      #club {


 
}
#horse {




}
#kep {

      background-color:  grey;  
      margin: auto;  

}
#cimsor {
        margin: auto;  
      background-color:  grey;    

}


        </style>
</head>
<body>
<div id="display">
<div>
  <div id="kep">
    
  </div>
</div>

<div class="header line">
  <img src="/storage/logo/logo_med.png" ><h2 id="header_name" class="pt-1">$event->event_name</h2>
</div>
<div id="rider" class="line">
<h1 id="rider_name" class="text-nowrap" >$start->rider_name</h1>
</div>
<div id="horse" class="line">
<h1 id="horse_name" class="text-nowrap" >$start->horse_name</h1>
</div>
<div id="club" class="line">

  <h1 id="club_name" class="text-nowrap" >$start->club</h1>

</div>

<h3 id="result" class="pt-2 text-nowrap">

</h3>

</div>
</body>

  <script src="{{ asset('js/displayAjax.js') }}"></script>
</html>
