@extends('layouts.app')
@section('title','Versenyszám hozzáadása')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add new event') }}</div>

                <div class="card-body">
                    <form method="POST" action="/addEvent" enctype="multipart/form-data">
                        @csrf



                       <div class="form-group row">
                            <label for="upload" class="col-md-4 col-form-label text-md-right">{{ __('Upload') }}</label>
                            <div class="col-md-6">
                                <input id="upload" type="file" class="form-control @error('upload') is-invalid @enderror" name="upload" value="{{ old('upload') }}" required>

                                @error('upload')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                      

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('New event') }}
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
