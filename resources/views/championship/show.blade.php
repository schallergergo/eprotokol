@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">


                
                <div class="card-header">
                    <span>{{$championship->championshipname}} </span>
                    @can('update',$championship)
                    
                    <a href="/championship/edit/{{$championship->id}}"></a>
                    
                    @endcan
                    <span class="float-right">
                        <a href="/championship/index">
                        {{__("Back")}}
                        </a>
                    </span>
                </div>

                <div class="card-body">
                    
                    @if (count($withAllStarts)!=0)
                    
                   
                   
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
                             <span class="align-middle font-weight-bold">{{__("Average")}}</span>
                        </div>

                    </div><!-- end of the row-->
                    
                    @endif
                    
                    @foreach ($withAllStarts as $starts)
                    
                    

                    <div class="row mb-2 border">
                        <div class="col-md-3 p-1 border">
                            <span class=" font-weight-bold">{{$starts["starts"]->first()->rider_name}} ({{$starts["starts"]->first()->rider_id}})</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border">
                            <span class=" font-weight-bold">{{$starts["starts"]->first()->horse_name}} ({{$starts["starts"]->first()->horse_id}})</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="font-weight-bold">{{$starts["starts"]->first()->club}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="font-weight-bold">{{$starts["starts"]->first()->category}}</span>
                        </div>
        
                        <div class="col-md-2 p-1 border">
                            <p class=font-weight-bold>{{__("Average")}}: {{$starts["avg"]}} %</p>
                        </div>
                    </div><!-- end of the row-->
                        @foreach ($starts["starts"]->sortBy("created_at") as $start)
                            <div class="row mb-2 ">
                        
                        <div class="col-md-1 p-1">
                            
                        </div>

                        
                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->event->competition->date}}</span>
                        </div>

                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$start->event->competition->name}}</span>
                        </div>

                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$start->event->event_name}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->mark}} p - {{$start->percent}} %</span>
                        </div>
        
                        
                    </div><!-- end of the row-->


                        @endforeach  <!-- end foreach starts[]-->
                        <div class="row mb-2"> <!--empty row --> </div>
                    @endforeach  <!-- end foreach withAllStarts-->
                    
                  
                    </div><!-- end of the card-->




                    @can("update",$championship)

                     <div class="card-header">
                        <span>{{$championship->championshipname}} - {{__("Not for the championship")}} </span>
                    
                    </div>

                     <div class="card-body">

                    @if (count($withoutAllStarts)!=0)
                    
                   
                   
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
                             <span class="align-middle font-weight-bold">{{__("Average")}}</span>
                        </div>

                    </div><!-- end of the row-->
                    
                    @endif
                    
                    @foreach ($withoutAllStarts as $starts)
                    
                    

                    <div class="row mb-2 border">
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$starts["starts"]->first()->rider_name}} ({{$starts["starts"]->first()->rider_id}})</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$starts["starts"]->first()->horse_name}} ({{$starts["starts"]->first()->horse_id}})</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$starts["starts"]->first()->club}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$starts["starts"]->first()->category}}</span>
                        </div>
        
                        <div class="col-md-2 p-1 border">
                            <p>{{__("Average")}}: {{$starts["avg"]}} %</p>
                        </div>
                    </div><!-- end of the row-->
                        @foreach ($starts["starts"]->sortBy("created_at") as $start)
                            <div class="row mb-2 ">
                        
                        <div class="col-md-1 p-1">
                            
                        </div>

                        <a href="tel:"></a>
                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->event->competition->date}}</span>
                        </div>

                         <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$start->event->competition->name}}</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$start->event->event_name}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->mark}} p - {{$start->percent}} %</span>
                        </div>
        
                        
                    </div><!-- end of the row-->


                        @endforeach  <!-- end foreach starts[]-->
                        <div class="row mb-2"> <!--empty row --> </div>
                    @endforeach  <!-- end foreach withoutAllStarts-->
                    
                  
                    </div><!-- end of the card-->

                    @endcan
                
     </div>
    </div>
</div>
</div>
@endsection
