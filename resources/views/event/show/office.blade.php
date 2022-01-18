@extends('layouts.app')
@section('pagespecificscripts')
    <script src="{{ asset('js/refresh.js') }}"></script>
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">


                
                <div class="card-header">{{$event->competition->name}} - {{$event->eventname}} </div>

                <div class="card-body">
                    @can('update',$event)
                    <a href="/start/create/{{$event->id}}" target="_blank">{{__("Add new rider")}}</a>
                    <a href="/event/export/{{$event->id}}" target="_blank">{{__("Export results")}}</a>
                    <a href="/event/edit/{{$event->id}}" target="_blank">{{__("Edit event")}}</a>
                    @endcan
                    @if (count($toStart)!=0)
                    
                   
                   
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
                    
                    @endif
                    @foreach ($toStart as $start)
                    
                    

                    <div class="row mb-2 border">
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$start->rider_name}} ({{$start->rider_id}})</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$start->horse_name}} ({{$start->horse_id}})</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->club}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->category}}</span>
                        </div>
        
                        <div class="col-md-2 p-1 border">

                            <span class="align-middle"><a href="/start/edit/{{$start->id}}" target="_blank">{{__("Edit info")}}</a></span>
                            <br>
                            @foreach ($start->result->sortBy('position') as $result)
                            @can('update',$result)
                             <span class="align-middle"><a href="/result/edit/{{$result->id}}" target="_blank">{{$result->position }}</a></span>
                             @endcan
                             @endforeach

                        </div>
                    </div><!-- end of the row-->

                    @endforeach
                    
                  
                    </div><!-- end of the card-->
                   
                <div class="card-header">{{__("Results")}}</div>

                <div class="card-body">
                    @if (count($started)!=0)
                    <div class="row mb-2 border">
                        <div class="col-md-2 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Rider")}}</span>
                        </div>
                        
                        <div class="col-md-2 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Horse")}}</span>
                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Club")}}</span>
                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Category")}}</span>
                        </div>
                        <div class="col-md-2 p-1 border d-none d-md-block">
                             <span class="align-middle font-weight-bold">{{__("Result")}}</span>
                            
                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block">
                             <span class="align-middle font-weight-bold">{{__("Options")}}</span>
                            
                        </div>
                    </div><!-- end of the row-->

                    @endif
                   
                    @foreach ($started as $start)
                    <div class="row mb-3 border">
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$start->rider_name}} ({{$start->rider_licence}})</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$start->horse_name}} ({{$start->horse_licence}})</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->club}}</span>
                        </div>
                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->category}}</span>
                        </div>
                    

                        <div class="col-md-3 p-1 border">
                            <span class="align-middle"><a href="/start/edit/{{$start->id}}" target="_blank">{{__("Edit info")}}</a></span>
                        @foreach ($start->result->sortBy('position') as $result)
                        <a href="/result/show/{{$result->id}}">{{$result->position}} {{__("judge")}}</a><br>
                        @endforeach
                        </div>
                    </div><!-- end of the row-->
                    
                    @endforeach
                    
                  
                    </div><!-- end of the card-->                  
     </div>
    </div>
</div>
</div>
@endsection
