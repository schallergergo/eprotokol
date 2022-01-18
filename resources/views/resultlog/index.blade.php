@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Result changes') }}</div>

                <div class="card-body">

                    <div class="row mb-2 border">
                        <div class="col-md-3 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Created at")}}</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Changed by")}}</span>
                        </div>

                        <div class="col-md-3 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Mark")}}</span>
                        </div>


                            <div class="col-md-3 p-1 border d-none d-md-block">
                   
                             <span class="align-middle font-weight-bold">{{__("Options")}}</span>
                            
                        </div>
                    </div><!-- end of the row-->
                    @foreach ($resultlogs as $resultlog)
                    <div class="row mb-2 border">
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$resultlog->created_at}}</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$resultlog->user}}</span>
                        </div>

                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$resultlog->mark}}</span>
                        </div>

                      

                        <div class="col-md-3 p-1 border">
                            <span class="align-middle"><a href="/resultlog/show/{{$resultlog->id}}" target="_blank">  {{__("View version")}}</a></span>
                            
                        </div>

                    </div><!-- end of the row-->
                    
                    @endforeach
                 
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
