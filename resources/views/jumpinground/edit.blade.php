@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


               
                    <form method="POST" action="/jumpinground/update/{{$round->id}}" enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")


                        <div class="card-header">{{$start->rider_name}} - {{$start->horse_name}} 1. {{ __('Jumping round') }}</div>
                         <div class="card-body">
                        <div class="form-group row">
                            <label for="time1" class="col-md-4 col-form-label text-md-right">{{ __('Time1') }}</label>

                            <div class="col-md-6">
                                <input id="time1" type="number" class="form-control @error('time1') is-invalid @enderror" name="time1" value="{{ $round->time1 }}" step="any"required>

                                @error('time1')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>


                        <div class="form-group row">
                            <label for="obstacle_fault1" class="col-md-4 col-form-label text-md-right">{{ __('Obstacle fault')}}</label>

                            <div class="col-md-6">
                                <input id="obstacle_fault1" type="number" class="form-control @error('obstacle_fault1') is-invalid @enderror" name="obstacle_fault1" value="{{ $round->obstacle_fault1 }}" step="any" required>

                                @error('obstacle_fault1')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">
                            <label for="time_fault1" class="col-md-4 col-form-label text-md-right">{{ __('Time fault') }}</label>

                            <div class="col-md-6">
                                <input id="time_fault1" type="number" class="form-control @error('time_fault1') is-invalid @enderror" name="time_fault1" value="{{ $round->time_fault1 }}" step="any" required>

                                @error('time_fault1')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>


                        <div class="form-group row">
                            <label for="total_fault1" class="col-md-4 col-form-label text-md-right">{{ __('Total fault') }}</label>

                            <div class="col-md-6">
                                <input id="total_fault1" type="number" class="form-control @error('total_fault1') is-invalid @enderror" name="total_fault1" value="{{ $round->total_fault1}}" step="any"required>

                                @error('total_fault1')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                         <div class="form-group row">
                            <label for="comments1" class="col-md-4 col-form-label text-md-right">{{ __('Comments1') }}</label>

                            <div class="col-md-6">
                                <textarea id="comments1" type="number" class="form-control @error('comments1') is-invalid @enderror" name="comments1" > {{$round->comments1}}</textarea>
                                @error('comments1')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        
                         <div class="form-group row">
                            <label for="eliminated1" class="col-md-4 col-form-label text-md-right">{{ __('Eliminated') }}</label>

                            <div class="col-md-6">
                                <select id="eliminated1" type="number" class="form-control @error('eliminated1') is-invalid @enderror" name="eliminated1" required> 
                                    <option value=0>{{__("Not eliminated1!")}}</option>
                                    <option value=1 @if ($round->eliminated1) selected @endif>{{__("Elimnated!")}}</option>
                                </select>
                                @error('eliminated1')
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
                        <form method="POST" action="/jumpinground/update2/{{$round->id}}" enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")

                     <div class="card">







                         <div class="card-header">2. {{ __('Jumping round') }}</div>
                         <div class="card-body">
                        <div class="form-group row">
                            <label for="time2" class="col-md-4 col-form-label text-md-right">{{ __('Time2') }}</label>

                            <div class="col-md-6">
                                <input id="time2" type="number" class="form-control @error('time2') is-invalid @enderror" name="time2" value="{{ $round->time2 }}" step="any" required >

                                @error('time2')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>


                        <div class="form-group row">
                            <label for="obstacle_fault2" class="col-md-4 col-form-label text-md-right">{{ __('Obstacle fault')}}</label>

                            <div class="col-md-6">
                                <input id="obstacle_fault2" type="number" class="form-control @error('obstacle_fault2') is-invalid @enderror" name="obstacle_fault2" value="{{ $round->obstacle_fault2 }}" step="any" required >

                                @error('obstacle_fault2')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">
                            <label for="time_fault2" class="col-md-4 col-form-label text-md-right">{{ __('Time fault') }}</label>

                            <div class="col-md-6">
                                <input id="time_fault2" type="number" class="form-control @error('time_fault2') is-invalid @enderror" name="time_fault2" value="{{ $round->time_fault2 }}" step="any" required >

                                @error('time_fault2')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>


                        <div class="form-group row">
                            <label for="total_fault2" class="col-md-4 col-form-label text-md-right">{{ __('Total fault') }}</label>

                            <div class="col-md-6">
                                <input id="total_fault2" type="number" class="form-control @error('total_fault2') is-invalid @enderror" name="total_fault2" value="{{ $round->total_fault2}}" step="any" required>

                                @error('total_fault2')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                         <div class="form-group row">
                            <label for="comments2" class="col-md-4 col-form-label text-md-right">{{ __('Comments2') }}</label>

                            <div class="col-md-6">
                                <textarea id="comments2" type="number" class="form-control @error('comments2') is-invalid @enderror" name="comments2" > {{$round->comments2}}</textarea>
                                @error('comments2')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        
                         <div class="form-group row">
                            <label for="eliminated2" class="col-md-4 col-form-label text-md-right">{{ __('Eliminated') }}</label>

                            <div class="col-md-6">
                                <select id="eliminated2" type="number" class="form-control @error('eliminated2') is-invalid @enderror" name="eliminated2" required> 
                                    <option value=0>{{__("Not eliminated2!")}}</option>
                                    <option value=1 @if ($round->eliminated2) selected @endif>{{__("Elimnated!")}}</option>
                                </select>
                                @error('eliminated2')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{$message}}</strong>
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
