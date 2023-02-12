@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Championships') }}


                    
                </div>

                <div class="card-body">

                    <div class="row mb-2 border">
                        <div class="col-md-5 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Championship name")}}</span>
                        </div>
                        
                        <div class="col-md-5 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Last updated")}}</span>
                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block ">
                            <span class="align-middle font-weight-bold">{{__("Options")}}</span>
                        </div>

                       
                    </div><!-- end of the row-->
                    @foreach ($championships as $championship)
                    <div class="row mb-2 border">
                        <div class="col-md-5 p-1 border">
                            <span class="align-middle">{{$championship->championshipname}}</span>
                        </div>
                        
                        <div class="col-md-5 p-1 border">
                            <span class="align-middle">{{__("Last updated")}}: {{$championship->updated_at}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">
                                
                                <a href="/championship/show/{{$championship->id}}">{{__("Show championship")}}</a><br>
                                @can ("update",$championship)
                                <a href="/championship/edit/{{$championship->id}}">{{__("Edit championship")}}</a>
                                @endcan
                            </span>
                        </div>

                      

                   
                    </div><!-- end of the row-->
                    
                    @endforeach
                    
                    <div class="row">
                        <div class="col-md-12 mt-2">
                       {{ $championships->links() }}
                        </div>
                       
                    </div><!-- end of the row-->
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
