
@extends('layouts.app')
@section ('title',$start->event->program->name." - ".$start->rider_name." - ".$start->horse_name)
@section('content')

<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{$start->rider_name}} - {{$start->horse_name}} - {{$start->club}}
                    @can('update',$result)
                        <span class="d-print-none">
                        <a href="/result/edit/{{$result->id}}">{{__("Edit result")}}</a>
                        </span>
                    @endcan
                    @if ($result->completed>1)
                    @can('viewAny',[App\Models\Resultlog::class,$result])
                        <span class="d-print-none">
                        <a href="/resultlog/index/{{$result->id}}">{{__("View versions")}}</a>
                        </span>
                    @endcan
                    @endif
                </div>
                
                <div class="card-body">
                 <div class="row">
                    <div class="col-md-7 p-2 border"><h5>{{ $start->event->program['name'] }}</h5></div>

                <div class="col-md-5 p-2 border"><h5>{{__("Remark")}}</h5></div>
                   
                </div>

                    <?php $i=0; ?>
                   @foreach ($blocks as $block)
                    <div class="row">
                    
                        <div class="col-md-1 p-1 border">
                            <p>{{ $block['ordinal'] }}</p>
                        </div>
                        @if ($block["programpart"]===1)
                        <div class="col-md-2 p-1 border">
                            <pre>{{ $block['letters'] }}</pre>
                        </div>
                        @endif
                        <div class="col-md-4 p-2 border">
                            <pre>{{ $block['criteria'] }}</pre>
                        </div>
                        
                      
                        
                    <div class="col-md-5 p-1 border">
                        <p>{{$assessment[$i]->remark}}</p>
                    </div>
                            </div> <!--end of the row-->
                        <?php $i++; ?>
                        @endforeach

                    
                    <div class="row">
                    
                        <div class="col-md-12 p-1 border">
                            <p>{{__("Leave arena at A in free walk")}}</p>
                        </div>
                    </div>
                    
                    @if ($start->event->program->doublesided)
                    <p style="page-break-before: always"></p>
                    @endif
                     <div class="row">
                    
                        <div class="col-md-12 p-1 border">
                            <strong>{{__("Collective marks")}}</strong>
                        </div>
                    </div>
<!-- Összbenyomás-->
                    @foreach ($collectivemarks as $block)
                    <div class="row">
                    
                        <div class="col-md-1 p-1 border">
                            <p>{{ $block['ordinal'] }}</p>
                        </div>
                        
                        <div class="col-md-2 p-1 border">
                            <pre>{{ $block['letters'] }}</pre>
                        </div>
                        
                        
                        <div class="col-md-4 p-1 border">
                            <pre>{{ $block['criteria'] }}</pre>
                        </div>
                        
                        
                        @if ($block['coefficient']===2)
                        <div class="col-md-1 p-1 border">
                            <center>
                                <p>{{ $block['maxmark'] }}X2</p>
                            </center>
                        </div>

                        @else
                        <div class="col-md-1 p-1 border">
                            <center>
                                <p>{{ $block['maxmark'] }}</p>
                            </center>
                        </div>
                        @endif
                        <div class="col-md-1 p-1 border">

                <h6 class="text-center">{{number_format($assessment[$i]->mark, 1)}}</h6>
                    </div>
                    <div class="col-md-3 p-1 border">
                        <p>{{$assessment[$i]->remark}}</p>
                    </div>
                            </div> <!--end of the row-->
                        <?php $i++; ?>

                        @endforeach
                        <div class="row">
                        <div class="col-md-12 p-1 border text-right">
                        @if ($result->eliminated==0)
                            {{__("Points")}}: <strong>{{number_format($result->mark, 1) }} {{__("points")}}  </strong>
                            - {{__("Percentage")}}: <strong>{{number_format($result->percent, 2) }} %       </strong>
                                @if ($result->error!=0 && $program->errortype==1)
                                - {{__("Deduction")}}: <strong>{{number_format($result->error, 0) }} {{__("points")}}</strong>
                                 @elseif ($result->error!=0 && $program->errortype==2)
                                - {{__("Deduction")}}!</strong>

                        @endif
                        @else
                        <strong>{{__("Eliminated!")}}</strong>
                        @endif

                                - {{__("Updated")}}: <strong>{{$result->updated_at}}</strong>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection


               

               
               

               