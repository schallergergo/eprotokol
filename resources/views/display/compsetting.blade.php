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
        float: left;


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
  <form id="events" method="POST" action="/display/storecompsetting/{{$competition->id}}">
     @csrf
@foreach($competition->event as $event)
<div class="form-check ml-2">
  <input class="form-check-input" type="checkbox" value="{{$event->id}}"  id="event-{{$event->id}}" name="events[]" 

  @if ( in_array($event->id,json_decode($competition->active_event))) checked @endif >
  <label class="form-check-label" for="event-{{$event->id}}">
    {{$event->event_name}}
  </label>
</div>
@endforeach
<input type="submit" name="send">
</form>
</div>
</body>

  <script src="{{ asset('js/displayAjax.js') }}"></script>
</html>
