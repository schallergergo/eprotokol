@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Sponsors') }}</div>

                <div class="card-body">

                    <div class="row mb-2 border">
                        <div class="col-md-4 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Sponsors")}}</span>
                        </div>
                        
                        <div class="col-md-5 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Url")}}</span>
                        </div>

                       
                       
                        <div class="col-md-3 p-1 border d-none d-md-block">
                             <span class="align-middle font-weight-bold">{{__("Options")}}</span>
                            
                        </div>
                    </div><!-- end of the row-->
                    @foreach ($sponsors as $sponsor)
                    <div class="row mb-2 border">
                        <div class="col-md-4 p-1 border">
                            <span class="align-middle">{{$sponsor->name}}</span>
                        </div>
                        
                        <div class="col-md-5 p-1 border">
                            <span class="align-middle"><a href="{{$sponsor->logo_url}}" target="_blank">{{$sponsor->logo_url}}</a></span>
                        </div>

                      

                        <div class="col-md-3 p-1 border">
                                <span class="align-middle"><a href="/sponsor/delete/{{$sponsor->id}}" >  {{__("Delete")}}</a></span>
                        </div>

                    </div><!-- end of the row-->
                    
                    @endforeach
                    
                    <div class="row">
                        <div class="col-md-12 mt-2">
                       {{ $sponsors->links() }}
                        </div>
                       
                    </div><!-- end of the row-->
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
