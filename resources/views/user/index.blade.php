@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">

                    <div class="row mb-2 border">
                        <div class="col-md-4 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Name")}}</span>
                        </div>
                        
                        <div class="col-md-4 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Email")}}</span>
                        </div>

                        <div class="col-md-4 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Options")}}</span>
                        </div>

                    </div><!-- end of the row-->
                    @foreach ($users as $user)
                    <div class="row mb-2 border">
                        <div class="col-md-4 p-1 border">
                            <span class="align-middle">{{$user->name}}</span>
                        </div>
                        
                        <div class="col-md-4 p-1 border">
                            <span class="align-middle">{{$user->email}}</span>
                        </div>

                        <div class="col-md-4 p-1 border">
                            @can ('view',$user)
                            <span class="align-middle"><a href="/start/index/{{$user->id}}" target="_blank">  {{__("View starts")}}</a></span>
                            @endcan
                            
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
