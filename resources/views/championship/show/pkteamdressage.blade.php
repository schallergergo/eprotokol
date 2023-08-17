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
                            <p class=font-weight-bold>({{$loop->index+1}}.) {{__("Average")}}:       {{ number_format($team_result["best_two"], 3) }} %</p>
                        </div>
                        
                    </div><!-- end of the row-->
                    </summary>
                       



                       @include("championship.show.components.event_result")
                        </details>
                    @endforeach  <!-- end foreach withAllStarts-->
                    
                  
                    </div><!-- end of the card-->

                    


                
     </div>
    </div>
</div>
</div>
@endsection
