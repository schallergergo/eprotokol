
@extends('layouts.app')

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
                    {{$start->rider_name}} - {{$start->horse_name}} - {{__("Result log view")}}

                </div>
                
                <div class="card-body">
                <div class="row">
                    <div class="col-md-7 p-1 border">
                        <h5>   {{ $start->event->program['name'] }} </h5>
                    </div>
                 <div class="col-md-1 p-1 border">
                        <h5>Max</h5>
                </div>
                <div class="col-md-1 p-1 border">
                        <h5>{{__("Mark")}}</h5>
                </div>
                <div class="col-md-3 p-1 border">
                        <h5>{{__("Remark")}}</h5>
                </div>
                   
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
                        @if ($block["programpart"]==1)
                        <div class="col-md-4 p-1 border">
                            <pre>{{ $block['criteria'] }}</pre>
                        </div>
                        @else
                        <div class="col-md-6 p-1 border">
                            <pre>{{ $block['criteria'] }}</pre>
                        </div>
                        @endif
                        
                        @if ($block['coefficient']===2)
                        <div class="col-md-1 p-1 border">
                            <center>
                                <p>{{ $block['maxmark'] }}X2</p>
                            </center>
                        </div>

                        @else
                        <div class="col-md-1 p-1 border">
                            <center>
                                <pre>{{ $block['maxmark'] }}</pre>
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
                    
                        <div class="col-md-12 p-1 border">
                            <p>{{__("Leave arena at A in free walk")}}</p>
                        </div>
                    </div>
                   
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
                        @if ($block["programpart"]===1)
                        <div class="col-md-2 p-1 border">
                            <pre>{{ $block['letters'] }}</pre>
                        </div>
                        @endif
                        @if ($block["programpart"]==1)
                        <div class="col-md-4 p-1 border">
                            <pre>{{ $block['criteria'] }}</pre>
                        </div>
                        @else
                        <div class="col-md-6 p-1 border">
                            <pre>{{ $block['criteria'] }}</pre>
                        </div>
                        @endif
                        
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
                        @if ($result->kizarva==0)
                            {{__("Points")}}: <strong>{{number_format($resultlog->mark, 1) }} {{__("points")}}  </strong>
                        @else
                        <strong>{{__("Eliminated!")}}</strong>
                        @endif

                                - {{__("Updated")}}: <strong>{{$resultlog->updated_at}}</strong>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection


               

               
               

               