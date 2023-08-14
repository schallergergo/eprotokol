@extends('layouts.app')
@section('title','Versenyszám hozzáadása')
@section('pagespecificscripts')


@endsection
@section('content')


<div class="container">
    @if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Qualification') }}</div>

                <div class="card-body">
                    <form method="GET" action="/qualification/show">
                        


                      <div class="form-group row">
                            <label for="start" class="col-md-4 col-form-label text-md-right">{{ __('Start date') }}</label>
                            <div class="col-md-6">
                                <input id="start" type="date" class="form-control @error('start') is-invalid @enderror" name="start" value="{{ old('start') }}" required>

                                @error('start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Not a date")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="end" class="col-md-4 col-form-label text-md-right">{{ __('End date') }}</label>
                            <div class="col-md-6">
                                <input id="end" type="date" class="form-control @error('end') is-invalid @enderror" name="end" value="{{ old('end') }}" required>

                                @error('end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Not a date")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                          <div class="form-group row">
                            <label for="percent" class="col-md-4 col-form-label text-md-right">{{ __('Percent') }}</label>
                            <div class="col-md-6">
                                <input id="percent" type="number" class="form-control @error('percent') is-invalid @enderror" name="percent" value="{{ old('percent') }}" required>

                                @error('percent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Must be a integer")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>
                            <div class="col-md-6">
                                <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="1" required>

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Must be an integer ")}} >1</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="download" class="col-md-4 col-form-label text-md-right">{{ __('Excel download') }}</label>
                            <div class="col-md-6">
                                <input id="download" type="checkbox" class="form-control form-check-input @error('download') is-invalid @enderror" name="download" value="download">

                                @error('download')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("I don't know ")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            
                            
                                @foreach ($programs as $program)
                                <div class="col-md-4"></div>
                                <div class="form-check ml-2 col-md-6">
                                  <input class="form-check-input" type="checkbox" value="{{$program->id}}"  id="program-{{$program->id}}" name="programs[]">
                                  <label class="form-check-label" for="program-{{$program->id}}">
                                    {{$program->name}}
                                  </label>
                                </div>
                                
                                @endforeach
                               
                            
                        </div>
                        
                       

                       

                       
 



                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
