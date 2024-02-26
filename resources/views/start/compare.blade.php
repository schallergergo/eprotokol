@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$start->rider_name}} - {{$start->horse_name}} - {{$start->club}}</div>

                <div class="card-body">

                     <div class="row">

                        <div class="col-md p-1 border">
                          <div class="form-outline">
                           <span> {{__("Ordinal")}}</span>
                          </div>
                        </div> <!-- end of the col-->


                        @foreach($start->result->sortBy("position") as $result)
                            <div class="col-md p-1 border">
                                <div class="form-outline">
                                    <span> {{$result->position}} {{__("judge")}} {{__("mark")}}</span>
                            </div>
                        </div> <!-- end of the col-->

                        <div class="col-md p-1 border">
                                <div class="form-outline">
                                    <span> {{$result->position}} {{__("judge")}} {{__("remark")}}</span>
                            </div>
                        </div> <!-- end of the col-->
                            
                        
                           @endforeach
                           </div> <!-- end of the row-->
                           @php 

                           $blockCount = count($program->block);


                           @endphp

                           @for($i=0;$i<$blockCount;$i++)

                             <div class="row">
                           
                            <div class="col-md p-1 border">
                              <div class="form-outline">
                                <span> {{$i+1}}. {{__("block")}}</span>
                              </div>
                        </div> <!-- end of the col-->

                            @foreach($start->result->sortBy("position") as $result)
                            <div class="col-md p-1 border">
                                <div class="form-outline">
                                    <span> {{number_format(json_decode($result->assessment)[$i]->mark,2)}} </span>
                            </div>
                        </div> <!-- end of the col-->

                        <div class="col-md p-1 border">
                                <div class="form-outline">
                                    <span> {{json_decode($result->assessment)[$i]->remark}}</span>
                            </div>
                        </div> <!-- end of the col-->
                            

                           @endforeach
                           </div> <!-- end of the row-->
                           @endfor

                    
                  
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
