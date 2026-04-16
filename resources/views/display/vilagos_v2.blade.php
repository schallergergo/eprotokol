<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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

.switch {
  position: relative;
  display: inline-block;
  width: 100px;
  height: 50px;
}

.switch input {
  display: none;
}

.slider {
  position: absolute;
  cursor: pointer;
  background-color: #28a745; /* green = test */
  border-radius: 50px;
  width: 100%;
  height: 100%;
  transition: 0.4s;
}

.slider:before {
  content: "";
  position: absolute;
  height: 40px;
  width: 40px;
  left: 5px;
  top: 5px;
  background-color: white;
  border-radius: 50%;
  transition: 0.4s;
}

/* LIVE mode */
input:checked + .slider {
  background-color: #dc3545; /* red */
}

input:checked + .slider:before {
  transform: translateX(50px);
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

     .display-row {
        display: flex;
      }

      .display {
        width: 520px;
        height: 280px;
        background-color: #dedede;
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
<input type="hidden" name="competition_id" id="competition_id" value="{{$competition->id}}">

<div class="display-row">

@include('display.vilagos_v2.first_a')
@include('display.vilagos_v2.second_a')
@include('display.vilagos_v2.third_a')

</div>



<div class="display-row">

<div class="display">
  <h1>itt lesz leírás</h1>

</div>

@include('display.vilagos_v2.second_b')


<div class="display">
 
<h1>masodik</h1>

</div>


</div>



  <script src="{{ asset('js/vilagos_v2/appState.js') }}"></script>
  <script src="{{ asset('js/vilagos_v2/liveToggle.js') }}"></script>
  <script src="{{ asset('js/vilagos_v2/pushToLive.js') }}"></script>
  <script src="{{ asset('js/vilagos_v2/getStarts.js') }}"></script>
  <script src="{{ asset('js/vilagos_v2/infoHandler.js') }}"></script>



</body>






  </html>
