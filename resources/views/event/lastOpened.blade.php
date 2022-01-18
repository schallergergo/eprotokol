@extends('layouts.app')
@section('pagespecificscripts')
    <script src="{{ asset('js/refresh.js') }}"></script>
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">


                
                <div class="card-header">{{$event->competition->name}} - {{$event->event_name}} </div>

        
                   
                    <div class="row mb-2 border">
                        <div class="col-md-3 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Rider")}}</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Horse")}}</span>
                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Club")}}</span>
                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Category")}}</span>
                        </div>
                        <div class="col-md-2 p-1 border d-none d-md-block">
                             <span class="align-middle font-weight-bold">{{__("Options")}}</span>
                        </div>

                    </div><!-- end of the row-->
                    
                    @if ($active!=null)
                    <div class="row mb-2 border">
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$active->rider_name}} ({{$active->rider_id}})</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$active->horse_name}} ({{$active->horse_id}})</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$active->club}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$active->category}}</span>
                        </div>
        
                        <div class="col-md-2 p-1 border">


                        </div>
                    </div><!-- end of the row-->
                    @endif

                  
       
                  
                    </div><!-- end of the card-->                  

    </div>
</div>
</div>
@endsection
