@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><span>{{ $competition->name." - ".$competition->date." - ".$competition->venue }}</span>
                     @can('create',[App\Models\Event::class,$competition])
                    <span class=""><a href="/event/create/{{$competition->id}}">{{__("Create event")}}</a></span>
                    <span class=""><a href="/display/compsetting/{{$competition->id}}">{{__("Display")}}</a></span>
                    <span class=""><a href="/finance/show/{{$competition->id}}">{{__("Finance")}}</a></span>
                    @endcan

                </div>

                <div class="card-body">

                    <div class="row mb-2 border">
                        <div class="col-md-4 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Event name")}}</span>
                        </div>
                        
                        <div class="col-md-4 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Program name")}}</span>
                        </div>

                        <div class="col-md-1 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Starts")}}</span>
                        </div>

                      
                        <div class="col-md-3 p-1 border d-none d-md-block">
                             <span class="align-middle font-weight-bold">{{__("Options")}}</span>
                            
                        </div>
                    </div><!-- end of the row-->

                    @foreach ($events as $event)
                    <div class="row mb-2 border">
                        <div class="col-md-4 p-1 border d-md-block">
                            <span class="align-middle">{{$event->event_name}}</span>
                        </div>
                        
                        <div class="col-md-4 p-1 border d-md-block">
                            <span class="align-middle">{{$event->program->name}}</span>
                        </div>

                        <div class="col-md-1 p-1 border d-md-block ">
                            <span class="align-middle">{{count($event->start)}} {{__("starts")}}</span>
                        </div>

                      
                        <div class="col-md-3 p-1 border d-md-block">
                             <span class="align-middle ">
                                <a href="/event/show/{{$event->id}}">{{__("View event")}}</a><br>
                                @can ("update",$event)
                                <a href="/event/edit/{{$event->id}}">{{__("Edit event")}}
                                @endcan
                                </a></span>
                            
                        </div>
                    </div><!-- end of the row-->                    
                    @endforeach
                    

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
