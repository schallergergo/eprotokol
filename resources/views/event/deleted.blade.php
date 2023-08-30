@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">


                
                <div class="card-header">
                    <span>{{$event->competition->name}} - {{$event->event_name}} </span>
                    <span class="float-right">
                        
                    </span>
                </div>

                <div class="card-body">
                   
     
                    
                   
                   
                    <div class="row mb-2 border">

                        <div class="col-md-3 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Rider")}}</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Horse")}}</span>
                        </div>

                        <div class="col-md-3 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Club")}}</span>
                        </div>
                         <div class="col-md-3 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Deleted_at")}}</span>
                        </div>



                    </div><!-- end of the row-->
                    

                    @foreach ($starts as $start)
                    
                    

                    <div class="row mb-2 border">
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$start->rider_name}} </span>
                        </div>
                        
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$start->horse_name}}</span>
                        </div>

                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$start->club}}</span>
                        </div>

                         <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$start->deleted_at}}</span>
                        </div>


        
                      
                    </div><!-- end of the row-->

                    @endforeach
                    
                  
                    </div><!-- end of the card-->
                   
       
               
     </div>
    </div>
</div>
</div>
@endsection
