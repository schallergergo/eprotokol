<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{__("Welcome!")}}</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png?v=1">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=1">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=1">
        <link rel="manifest" href="/site.webmanifest?v=1">
        <link rel="mask-icon" href="/safari-pinned-tab.svg?v=1" color="#5bbad5">
        <link rel="shortcut icon" href="/favicon.ico?v=1">
        <meta name="msapplication-TileColor" content="#00aba9">
        <meta name="theme-color" content="#ffffff">

         <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .links >a  {
                color: #636b6f;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            .m-md {
                margin: 30px;
            }
        </style>
    

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">{{__("Home")}}</a>
                    @else
                        <a href="{{ route('login') }}">{{__("Login")}}</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{__("Register")}}</a>
                    
                        @endif
                    @endauth
                </div>
            @endif
            <div class="content">
                <div class="title m-md">
                    <img src="/storage/logo/logo_med.png" class="img-fluid m-10" alt="Eprotokol logo">
                </div>
                <div class="col-md-12">
                <div class="links row mb-2">
                    <div class="col-md-3 "><span class="links"><a href="/result/search">{{__("Search")}}</a></span></div>
                    <div class="col-md-3 "><span class="links"><a href="/competition/index">{{__("Competitions")}}</a></span></div>
                    <div class="col-md-3 "><span class="links"><a href="/competition/index">{{__("Programs")}}</a></span></div>
                    <div class="col-md-3 ">
                    @if (session('locale')=='en')
                  	
                    <span class="links"><a href="lang/hu">Magyar</a></span>
                  	@else
                    <span class="links"><a href="lang/en">English</a></span>

                  	
                  	
                  	@endif
                    </div>

                     
                    
                </div>
            </div>
        </div>
        </div>
    </body>
</html>