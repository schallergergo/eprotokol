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

                    @foreach ($results as $result)
                    <div class="row mb-2 border">
                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$result->event->date}}</span>
                        </div>
                        
                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$result->event->venue}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$result->event->competitionname}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$result->rider_name}} - {{$result->horse_name}}</span>
                        </div>
                        <div class="col-md-2 p-1 border">
                            @if ($result->eliminated)
                                <span class="aalign-middle">{{__("Eliminated")}}</span>
                            @else
                                <span class="align-middle">{{$result->mark}} {{__("points")}} - {{number_format($result->percent,2)}}%</span>
                            @endif
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle"><a href="/result/show/{{$result->id}}" target="_blank">  {{__("View the test sheet")}}</a></span>
                            
                        </div>
                    </div><!-- end of the row-->
                    
                    @endforeach
                    
                    <div class="row">
                        <div class="col-md-12 mt-2">
                       {{ $results->links() }}
                        </div>
                       
                    </div><!-- end of the row-->
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
