@extends('layouts.app')
@section('title','Sponsor')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Sponsor') }}</div>

                <div class="card-body">
                    <form method="POST" action="/sponsor/store" enctype="multipart/form-data">
                        @csrf



                       <div class="form-group row">
                            <label for="sponsor_name" class="col-md-4 col-form-label text-md-right">{{ __('Name of the sponsor') }}</label>
                            <div class="col-md-6">
                                <input id="sponsor_name" type="text" class="form-control @error('sponsor_name') is-invalid @enderror" name="sponsor_name" value="{{ old('sponsor_name') }}" required>

                                @error('sponsor_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                       <div class="form-group row">
                            <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Name of the sponsor') }}</label>
                            <div class="col-md-6">
                                
                                <input class="form-control" type="file" id="logo" name="logo"accept=".jpg, .png, .jpeg,|image/*">
                                @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('New sponsor') }}
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


