@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Riders') }}</div>

                <div class="card-body">

                    <div class="row mb-2 border">
                        <div class="col-md-4 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Name")}}</span>
                        </div>
                        

                        <div class="col-md-4 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Options")}}</span>
                        </div>

                    </div><!-- end of the row-->
                    @foreach ($starts as $start)
                    <div class="row mb-2 border">
                        <div class="col-md-4 p-1 border">
                            <span class="align-middle">{{$start->rider_name}}</span>
                        </div>

                        <div class="col-md-4 p-1 border">
                            
                            <span class="align-middle"><a href="/start/index/rider/{{$start->rider_id}}" target="_blank">  {{__("View starts")}}</a></span>
                            
                        </div>

                    </div><!-- end of the row-->
                    
                    @endforeach
                    
                    <div class="row">
                        <div class="col-md-12 mt-2">
                       {{ $users->links() }}
                        </div>
                       
                    </div><!-- end of the row-->
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
