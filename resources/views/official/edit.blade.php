@extends('layouts.app')
@section('title','Tisztségviselők hozzáadása')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modify official') }}</div>

                <div class="card-body">
                    <form method="POST" action="/official/update/{{$official->id}}" enctype="multipart/form-data">
                        @csrf
                        @method ("PATCH")


                       <div class="form-group row">
                            <label for="judge" class="col-md-4 col-form-label text-md-right">{{ __('Judge') }}</label>
                            <div class="col-md-6">
                                <input id="judge" type="text" class="form-control @error('judge') is-invalid @enderror" name="judge" value="{{ $official->judge}}" required>

                                @error('judge')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="position" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>

                            <div class="col-md-6">
                                <select id="position"  class="form-control @error('position') is-invalid @enderror" name="position"  disabled>

                                <option> {{$official->position}} {{__("judge")}}</option>
                               
                            </select>

                            </div>

                        </div>

                         <div class="form-group row">
                            <label for="penciler" class="col-md-4 col-form-label text-md-right">{{ __('Penciler') }}</label>

                            <div class="col-md-6">
                                <select id="penciler"  class="form-control @error('penciler') is-invalid @enderror" name="penciler"  required>

                                <option value=""> {{__("Select a penciler")}} </option>
                                

                            @foreach ($pencilers as $penciler)
                                <option value="{{$penciler->id}}" 
                                    @if ($official->penciler===$penciler->id) selected @endif
                                    >
                                     {{$penciler->name}} 
                                </option>
                            @endforeach
                            </select>

                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
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
