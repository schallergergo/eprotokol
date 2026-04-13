@extends('layouts.app')
@section('title',__("Edit competition"))

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                    <form method="POST" action="/joker/update/{{$start->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        @foreach($start->result as $result)
                <div class="card-header">{{$start->rider_name}} - {{$start->horse_name}}  {{$result->position}} {{__('judge')}}
                


                <span class="float-right">
                   
                    <a href="/event/show/{{$start->event->id}}">{{__("Back")}}</a>
                </span>

                
                </div>

                <div class="card-body">
                            
                            
                        <input type="hidden" name="results[{{ $result->id }}][id]" value="{{ $result->id }}">

                          <div class="form-group row">

                            <label for="given_mark" class="col-md-4 col-form-label text-md-right">{{ __('Given mark') }}</label>

                            <div class="col-md-6">

                                <input type="number" class="form-control @error('mark') is-invalid @enderror" 
                                name="results[{{ $result->id }}][mark]" value='{{$result->mark}}'>



                                @error('results[{{ $result->id }}][id]')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{__("Something is wrong... I know very helpful.")}}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>



                            <div class="form-group row">

                            <label for="given_mark" class="col-md-4 col-form-label text-md-right">{{ __('Collective') }}</label>

                            <div class="col-md-6">

                                <input type="number" class="form-control @error('collective') is-invalid @enderror" 
                                name="results[{{ $result->id }}][collective]" value='{{$result->collective}}'>



                                @error('results[{{ $result->id }}][id]')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{__("Something is wrong... I know very helpful.")}}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>
            
            






                      

                       
                        </div>
                         @endforeach

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    
                
               
                </form>
            </div> <!--card -->
        </div>
    </div>
</div>
@endsection
