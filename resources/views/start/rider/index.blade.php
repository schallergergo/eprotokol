@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Own results') }}</div>

                <div class="card-body">

                    <div class="row mb-2 border">
                        <div class="col-md-2 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Date")}}</span>
                        </div>
                        
                        <div class="col-md-2 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Venue")}}</span>
                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Event")}}</span>
                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Competitor")}}</span>
                        </div>
                        <div class="col-md-2 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Result")}}</span>
                        </div>
                        <div class="col-md-2 p-1 border d-none d-md-block">
                             <span class="align-middle font-weight-bold">{{__("Options")}}</span>
                            
                        </div>
                    </div><!-- end of the row-->

                    @foreach ($starts as $start)
                    <div class="row mb-2 border">
                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->event->competition->date}}</span>
                        </div>
                        
                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->event->competition->venue}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->event->competition->name}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$start->rider_name}} - {{$start->horse_name}}</span>
                        </div>
                        <div class="col-md-2 p-1 border">
                            @if ($start->eliminated)
                                <span class="aalign-middle">{{__("Eliminated")}}</span>
                            @else
                                <span class="align-middle">{{$start->mark}} {{__("points")}} - {{number_format($start->percent,2)}}%</span>
                            @endif
                        </div>

                        <div class="col-md-2 p-1 border">
                            @foreach($start->result->sortBy('position') as $result)
                            <a href="/result/show/{{$result->id}}">{{$result->position}} {{__("judge")}}</a><br>
                            @endforeach
                            
                        </div>
                    </div><!-- end of the row-->
                    
                    @endforeach
                    
                    <div class="row">
                        <div class="col-md-12 mt-2">
                       {{ $starts->links() }}
                        </div>
                       
                    </div><!-- end of the row-->
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
