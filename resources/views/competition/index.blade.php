@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Competition') }}

                    @can('create',App\Models\Competition::class)
                    <span class="ml-2"><a href="/competition/create">{{__("Create competition")}}</a></span>
                    
                    @endcan
                     @can('create',App\Models\User::class)
                    <span class="ml-2"><a href="/user/create">{{__("Create user")}}</a></span>
                    
                    @endcan
                </div>

                <div class="card-body">

                    <div class="row mb-2 border">
                        <div class="col-md-2 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Date")}}</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Venue")}}</span>
                        </div>

                        <div class="col-md-3 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Competition")}}</span>
                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Event")}}</span>
                        </div>
                       
                        <div class="col-md-2 p-1 border d-none d-md-block">
                             <span class="align-middle font-weight-bold">{{__("Options")}}</span>
                            
                        </div>
                    </div><!-- end of the row-->
                    @foreach ($competitions as $competition)
                    <div class="row mb-2 border">
                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$competition->date}}</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$competition->venue}}</span>
                        </div>

                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$competition->name}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{count($competition->event)}} </span>
                        </div>
                      

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle"><a href="/competition/show/{{$competition->id}}">  {{__("View competition")}}</a></span><br>
                            @can ('update',$competition)
                                @if ($competition->active==0)
                                    <span class="align-middle">
                                        <a class="text-danger" href="/competition/updateActive/{{$competition->id}}">{{__("Closed competition")}}</a>
                                    </span>
                                @else
                                    <span class="align-middle">
                                        <a href="/competition/edit/{{$competition->id}}">  {{__("Edit competition")}}</a>
                                    </span>
                                @endif                           
                             @endcan
                            
                        </div>

                    </div><!-- end of the row-->
                    
                    @endforeach
                    
                    <div class="row">
                        <div class="col-md-12 mt-2">
                       {{ $competitions->links() }}
                        </div>
                       
                    </div><!-- end of the row-->
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
