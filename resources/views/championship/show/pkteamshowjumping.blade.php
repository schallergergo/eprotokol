@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">


              
                <div class="card-header">
                    <span>{{$championship->championshipname}}  </span>
                    @can('update',$championship)
                    
                    <a href="/championship/edit/{{$championship->id}}"></a>
                    
                    @endcan
                    <span class="float-right d-print-none">
                        <a href="/championship/index">
                        {{__("Back")}}
                        </a>
                    </span>
                </div>

                <div class="card-body">
                    @if (count($team_results)!=0)
                    
                   
                   
                    <div class="row mb-2 border">
                        <div class="col-md-4 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Team name")}}</span>
                        </div>
                        
                        <div class="col-md-4 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Team members")}}</span>
                        </div>

                        <div class="col-md-4 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Result")}}</span>
                        </div>



                    </div><!-- end of the row-->
                    
                    @endif
                    
                    @foreach ($team_results as $team_result)

                   
                    <details>
                    <summary style="list-style-type: none;">
                    <div class="row mb-2 border">
                        
                        <div class="col-md-4 p-1 border">
                            <span class=" font-weight-bold">{{$team_result["team"]->name}}</span>
                        </div>
                        
                        <div class="col-md-4 p-1 border">
                            

                            @foreach($team_result["team"]->team_member as $member)
                            <span class=" font-weight-bold">{{$member->rider_name}} - {{$member->horse_name}}</span> <br>

                            @endforeach
                        </div>
        
                        <div class="col-md-4 p-1 border">
                            <p class=font-weight-bold>({{$loop->index+1}}.) {{__("Total fault")}}:       {{ number_format($team_result["best_two"], 1) }} hp</p>
                        </div>
                        
                    </div><!-- end of the row-->
                    </summary>
                       



                @foreach ($team_result["event_results"] as $event_result)


                            <div class="row mb-2 ">
                        


                        
                        <div class="col-md-4 p-1 border">
                            <span class="align-middle font-weight-bold">{{$event_result["event"]->competition->date}}</span>
                        </div>


                        <div class="col-md-4 p-1 border">
                            <span class="align-middle font-weight-bold">{{$event_result["event"]->event_name}}</span>
                        </div>

                        <div class="col-md-4 p-1 border">
                            <span class="align-middle font-weight-bold">{{__("Total fault")}}:       {{ number_format($event_result["best_two"], 1) }} hp</span>
                        </div>

                       
                        
                    </div><!-- end of the row-->
                    
 
                        @foreach($event_result["starts"] as $start)
                        <div class="row mb-2 ">
                        
                                <div class="col-md-1 p-1">
                                    
                                </div>

                                
                                <div class="col-md-4 p-1 border">
                                    <span class="align-middle">{{$start->rider_name}} ( {{$start->rider_id}} )  </span>
                                </div>

                                <div class="col-md-4 p-1 border">
                                    <span class="align-middle">{{$start->horse_name}} ( {{$start->horse_id}}</span>
                                </div>


                                <div class="col-md-3 p-1 border">
                                    <span class="align-middle">{{$start->mark}} hp </span>
                                </div>
        
                        
                        </div><!-- end of the row-->
                        @endforeach <!-- end foreach starts-->

                        @endforeach  <!-- end foreach eventresults-->


                        
                        </details>
                    @endforeach  <!-- end foreach withAllStarts-->
                    
                  
                    </div><!-- end of the card-->

                    


                
     </div>
    </div>
</div>
</div>
@endsection
