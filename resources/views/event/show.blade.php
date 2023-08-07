@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">


                
                <div class="card-header">
                    <span>{{$event->competition->name}} - {{$event->event_name}} </span>
                    @can ("create",[App\Models\Start::class,$event])
                        <a href="/start/create/{{$event->id}}" >{{__("Add new rider")}}</a>
                    @endcan
                    @can('update',$event)
                        <a href="/event/export/{{$event->id}}" target="_blank">{{__("Export results")}}</a>
                        <a href="/event/edit/{{$event->id}}">{{__("Edit event")}}</a>
                    @endcan
                    <span class="float-right">
                        <a href="/competition/show/{{$event->competition->id}}">
                        {{__("Back")}}
                        </a>
                    </span>
                </div>

                <div class="card-body">

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
                             @can('update',$start)
                            <span class="align-middle"><a href="/start/edit/{{$start->id}}" target="">{{__("Edit info")}}</a></span>
                            <span class="align-middle"><a href="/start/moveUp/{{$start->id}}">⬆️</a></span>
                            <span class="align-middle"><a href="/start/moveDown/{{$start->id}}">⬇️</a></span>
                            <br>
                            @endcan
                            @foreach ($start->result->sortBy('position') as $result)
                            
                            @can('update',$result)

                             <span class="align-middle"><a href="/result/edit/{{$result->id}}" target="">{{$result->position}} {{__("judge")}}</a></span><br>

                             @endcan
                             @endforeach

                        </div>
                    </div><!-- end of the row-->

                    @endforeach
                    
                  
                    </div><!-- end of the card-->
                @foreach($startedArray as $started)
                @if (count($started)!=0)
                <div class="card-header">{{$started->first()->category}} {{__("results")}}</div>

                <div class="card-body">
                    
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
                             <span class="align-middle font-weight-bold">{{__("Final result")}}</span>
                            
                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block">
                             <span class="align-middle font-weight-bold">{{__("Results")}}</span>
                            
                        </div>
                    </div><!-- end of the row-->

                    
                    
                    @foreach ($started as $start)
                    <div class="row mb-3 border">
                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->rider_name}} ({{$start->rider_id}})</span>
                        </div>
                        
                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->horse_name}} ({{$start->horse_id}})</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->club}}</span>
                        </div>
                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->category}}</span>
                        </div>
                    <div class="col-md-2 p-1 border">
                            <span class="align-middle">
                                ({{$start->rank}}.) {{$start->mark}}p  - {{number_format($start->percent,3)}}% @if ($start->collective!=0)- {{$start->collective}}p @endif
                            </span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            @can('update',$start)
                            <span class="align-middle"><a href="/start/edit/{{$start->id}}" target="">{{__("Edit info")}}</a></span>
                            <br>
                            @endcan

                        @foreach ($start->result->sortBy('position') as $result)
                        @can ('checkAfter', $result)
                        <a href="/result/show/{{$result->id}}">


                            @if ($result->eliminated) {{__("Eliminated!")}}
                            @else 


                             <span title="{{__('Judge')}}">{{$result->position}}: </span>
                            <span title="{{__('Point')}}">{{$result->mark}}p </span> - 
                             <span title="{{__('Percentage')}}">{{$result->percent}}% </span> - 
                             <span title="{{__('Collective mark')}}">{{$start->collective}}p </span>


                            @endif

                        </a><br>
                        @else <!-- belongs to can. dont look for the if-->
                        <span class="align-middle">

                         @if ($result->eliminated) {{__("Eliminated!")}}
                       @else <span title="{{__('Judge')}}">{{$result->position}}: </span>
                             <span title="{{__('Point')}}">{{$result->mark}}p </span> - 
                             <span title="{{__('Percentage')}}">{{$result->percent}}% </span> - 
                             <span title="{{__('Collective mark')}}">{{$start->collective}}p </span>

                        @endif</span>
                        <br>
                        
                        @endcan
                        @endforeach
                        </div>
                    </div><!-- end of the row-->
                    
                    @endforeach
                    
                    @endif
                    </div><!-- end of the card-->   
                    @endforeach               
     </div>
    </div>
</div>
</div>
@endsection
