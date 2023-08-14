@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


               
                    <form method="POST" action="/jumpinground/update/{{$round->id}}" enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")


                        <div class="card-header">{{ __('Jumping round') }} {{$round->round_number}}</div>
                         <div class="card-body">
                        <div class="form-group row">
                            <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Time') }}</label>

                            <div class="col-md-6">
                                <input id="time" type="number" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ $round->time }}" step="any">

                                @error('time')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>


                        <div class="form-group row">
                            <label for="obstacle_fault" class="col-md-4 col-form-label text-md-right">{{ __('Obstacle fault')}}</label>

                            <div class="col-md-6">
                                <input id="obstacle_fault" type="number" class="form-control @error('obstacle_fault') is-invalid @enderror" name="obstacle_fault" value="{{ $round->obstacle_fault }}" step="any">

                                @error('obstacle_fault')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">
                            <label for="time_fault" class="col-md-4 col-form-label text-md-right">{{ __('Time fault') }}</label>

                            <div class="col-md-6">
                                <input id="time_fault" type="number" class="form-control @error('time_fault') is-invalid @enderror" name="time_fault" value="{{ $round->time_fault }}" step="any">

                                @error('time_fault')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>


                        <div class="form-group row">
                            <label for="total_fault" class="col-md-4 col-form-label text-md-right">{{ __('Total fault') }}</label>

                            <div class="col-md-6">
                                <input id="total_fault" type="number" class="form-control @error('total_fault') is-invalid @enderror" name="total_fault" value="{{ $round->total_fault}}" step="any">

                                @error('total_fault')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                         <div class="form-group row">
                            <label for="comments" class="col-md-4 col-form-label text-md-right">{{ __('Total fault') }}</label>

                            <div class="col-md-6">
                                <textarea id="comments" type="number" class="form-control @error('comments') is-invalid @enderror" name="comments" ></textarea>
                                @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                      


                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </div>
                        </div>
                        
                    </form>

        </div>
    </div>
    </div>
</div>
@endsection
