@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


               
                    <form method="POST" action="/style/update/{{$style->id}}" enctype="multipart/form-data" name="styleForm" onsubmit="return validateForm()">
                        @csrf
                        @method("PATCH")


                        <div class="card-header">{{$start->rider_name}} - {{$start->horse_name}} . {{ __('Style') }}</div>
                         <div class="card-body">

                        <div class="form-group row">
                            <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Time') }}</label>

                            <div class="col-md-6">
                                <input id="time" type="number" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ $style->time }}" step="any"required>

                                @error('time')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>


                        <div class="form-group row">
                            <label for="total_fault" class="col-md-4 col-form-label text-md-right">"A" / {{ __('Total fault')}} </label>

                            <div class="col-md-6">
                                <input id="total_fault" type="number" class="form-control @error('total_fault') is-invalid @enderror" name="total_fault" value="{{ $style->total_fault }}" step="any" required>

                                @error('total_fault')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">
                            <label for="given_mark" class="col-md-4 col-form-label text-md-right">{{ __('Given mark') }}</label>

                            <div class="col-md-6">
                                <input id="given_mark" type="number" class="form-control @error('given_mark') is-invalid @enderror" name="given_mark" value="{{ $style->given_mark }}" step="any" maximum=10 required>

                                @error('given_mark')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>


                        <div class="form-group row">
                            <label for="deductions" class="col-md-4 col-form-label text-md-right">{{ __('Deduction') }}</label>

                            <div class="col-md-6">
                                <input id="deductions" type="number" class="form-control @error('deductions') is-invalid @enderror" name="deductions" value="{{ $style->deductions}}" step="any"required>

                                @error('deductions')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>


                        <div class="form-group row">
                            <label for="total_mark" class="col-md-4 col-form-label text-md-right">{{ __('Final mark') }}</label>

                            <div class="col-md-6">
                                <input id="total_mark" type="number" class="form-control @error('total_mark') is-invalid @enderror" name="total_mark" value="{{ $style->total_mark}}" step="any"required>

                                @error('total_mark')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                         <div class="form-group row">
                            <label for="comments" class="col-md-4 col-form-label text-md-right">{{ __('Comments') }}</label>

                            <div class="col-md-6">
                                <textarea id="comments" type="number" class="form-control @error('comments') is-invalid @enderror" name="comments" > {{$style->comments}}</textarea>
                                @error('comments')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        
                         <div class="form-group row">
                            <label for="eliminated" class="col-md-4 col-form-label text-md-right">{{ __('Eliminated') }}</label>

                            <div class="col-md-6">
                                <select id="eliminated" type="number" class="form-control @error('eliminated') is-invalid @enderror" name="eliminated" required> 
                                    <option value=0>{{__("Not eliminated!")}}</option>
                                    <option value=1 @if ($style->eliminated) selected @endif>{{__("Eliminated")}}</option>
                                </select>
                                @error('eliminated')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>


                        <div class="form-group row mb-0"
>                            <div class="col-md-6 offset-md-4">
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

