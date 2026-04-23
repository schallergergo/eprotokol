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
/* FULLSCREEN CONTAINER */
.fullscreen-display {
    width: 100vw;
    height: 100vh;
    background-color: #dedede;

    display: flex;
    flex-direction: column;

    /* 🔥 FIX */
    justify-content: center;

    padding: 2vh 3vw;
    box-sizing: border-box;
}

/* HEADER */
.fs-header {
    position: absolute;
    top: 4vh;
    left: 3vw;

    display: flex;
    align-items: center;
}

.fs-logo {
    height: 10vh;
    margin-right: 2vw;
}

/* CONTENT CENTERED */
.fs-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 3vh;
    text-align: center;
}

/* TEXT SCALING */
.header_name {
    font-size: 10vh;
}

.rider_name {
    font-size: 10vh;
    font-weight: bold;
}

.horse_name {
    font-size: 8vh;
}

.club_name {
    font-size: 8vh;
}

.result {
    font-size: 6vh;
    margin-top: 2vh;
}


</style>
</head>
 <body>
<input type="hidden" name="competition_id" id="competition_id" value="{{$competition->id}}">
<div class="fullscreen-display main-display display">

  <div class="fs-header">
    <img src="/storage/logo/logo_med.png" class="fs-logo">
    <h2 class="header_name"></h2>
  </div>

  <div class="fs-content">

    <h1 class="rider_name"></h1>

    <h1 class="horse_name"></h1>

    <h1 class="club_name"></h1>

    <h2 class="result"></h2>

  </div>

</div>





  <script src="{{ asset('js/vilagos_v2/appState.js') }}"></script>
  <script src="{{ asset('js/vilagos_v2/liveToggle.js') }}"></script>
  <script src="{{ asset('js/vilagos_v2/pushToLive.js') }}"></script>
  <script src="{{ asset('js/vilagos_v2/getStarts.js') }}"></script>

  <script src="{{ asset('js/vilagos_v2/infoHandler.js') }}"></script>


  <script>
    
$(document).ready(function () {

    console.log('App initialized');

    // 🔹 ensure competitionId exists
    if (!App.state.competitionId) {
        console.error('Missing competitionId');
        return;
    }

    // 🔹 set LIVE mode automatically (for fullscreen display)
    App.state.mode = 'live';

    // 🔹 start polling immediately
    startLivePolling();

});

  </script>



</body>






  </html>
