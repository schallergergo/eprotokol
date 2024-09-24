@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Not registered') }}</div>

                <div class="card-body">

                    <div class="row mb-3 border">
                        <div class="col-md-1 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Userlicence")}}</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("User name")}}</span>
                        </div>

                        <div class="col-md-3 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Rider licence")}}</span>
                        </div>

                        <div class="col-md-3 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Ridername")}}</span>
                        </div>
                       
                    </div><!-- end of the row-->
                    @foreach ($starts as $start)
                    <div class="row mb-2 border">
                        <div class="col-md-1 p-1 border">
                            <span class="align-middle">{{$start->rider_id}}</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$start->rider_name}}</span>
                        </div>

                        <div class="col-md-3 p-1 border">
                            <span class="align-middle"></span>
                        </div>

                        <div class="col-md-3 p-1 border">
                            <span class="align-middle"></span>
                        </div>
                      

     
                    </div><!-- end of the row-->
                    
                    @endforeach
                    
                    <div class="row">
                        <div class="col-md-12 mt-2">
    
                        </div>
                       
                    </div><!-- end of the row-->
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
