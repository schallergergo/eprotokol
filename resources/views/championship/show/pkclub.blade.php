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
                    @if (count($clubs)!=0)
                    
                   
                   
                    <div class="row mb-2 border">
                        <div class="col-md-6 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Club name")}}</span>
                        </div>
                        


                        <div class="col-md-6 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Result")}}</span>
                        </div>



                    </div><!-- end of the row-->
                    
                    @endif
                    
                    @foreach ($clubs as $club)

                   
                    <details>
                    <summary style="list-style-type: none;">
                    <div class="row mb-2 border">
                        
                        <div class="col-md-6 p-1 border">
                            <span class=" font-weight-bold">{{$club["club"]}}</span>
                        </div>
                        
                      
        
                        <div class="col-md-6 p-1 border">
                            <p class=font-weight-bold>({{$loop->index+1}}.) {{__("Total point")}}:       {{ number_format($club["score"], 3) }} p</p>
                        </div>
                        
                    </div><!-- end of the row-->
                    </summary>
                       



                       <div class="row mb-2 ">
                            <div class="col-md-1 p-1"> </div>
                            <div class="col-md-3 p-1 border">
                                    <span class=" font-weight-bold">{{__("Rider name")}}</span>
                                </div>
                                <div class="col-md-2 p-1 border">
                                    <span class=" font-weight-bold">Futószár 1, 2</span>
                                </div>

                                 <div class="col-md-2 p-1 border">
                                    <span class=" font-weight-bold">Előkezdő 2</span>
                                </div>

                                 <div class="col-md-2 p-1 border">
                                    <span class=" font-weight-bold">Kezdő gyerek 1, 2 <br>Kezdő ifi 1, 2 <br>Haladó 1, 2</span>
                                </div>

                                 <div class="col-md-2 p-1 border">
                                    <span class=" font-weight-bold">PK1</span>
                                </div>
                        </div><!-- end of the row-->
                        @php 
                            $pointArray = $club["pointArray"]
                        @endphp
                            

                        @foreach ($club["riderArray"] as $riderArray)

                        @php 
                            $index = $loop->index;
                            $start = $riderArray["data"];
                        @endphp
                            
                        
                        <div class="row mb-2 ">
                            <div class="col-md-1 p-1"> </div>
                            <div class="col-md-3 p-1 border">
                                    <span class="font-weight-bold">{{$riderArray["name"]}}</span>
                                </div>
                                <div class="col-md-2 p-1 border">
                                      @if($start[0]!=null)
                                    <span title='{{$start[0]->event->event_name}}' class=" @if ($index==$pointArray[0])font-weight-bold @endif">
                                        {{number_format($start[0]->percent,2)}}
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-2 p-1 border">
                                      @if($start[1]!=null)
                                    <span title='{{$start[1]->event->event_name}}' class=" @if ($index==$pointArray[1])font-weight-bold @endif">
                                  
                                        {{number_format($start[1]->percent,2)}}
                                    
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-2 p-1 border">
                                    @if($start[2]!=null)
                                    <span title='{{$start[2]->event->event_name}}' class=" @if ($index==$pointArray[2])font-weight-bold @endif">
                                    
                                        {{number_format($start[2]->percent,2)}}
                                    
                                    </span>
                                    @endif
                                </div>

                                <div class="col-md-2 p-1 border">
                                    @if($start[3]!=null)
                                    <span title='{{$start[3]->event->event_name}}' class="@if ($index==$pointArray[3])font-weight-bold @endif">
                                    
                                        {{number_format($start[3]->percent,2)}}
                                    
                                    </span>
                                    @endif
                                </div>
                        </div><!-- end of the row-->
 
                       

                        @endforeach  <!-- end foreach eventresults-->


                        
                        </details>
                    @endforeach  <!-- end foreach withAllStarts-->
                    
                  
                    </div><!-- end of the card-->

                    


                
     </div>
    </div>
</div>
</div>
@endsection
