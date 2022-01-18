@extends('layouts.app')
@section('title','Versenyzők hozzáadása')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit start') }}
                    @can('delete',$start)
                    <span class="float-right">
                        <a href="/start/delete/{{$start->id}}">{{__("Delete start")}}</a>
                    </span>
                    @endcan
                </div>

                <div class="card-body">
                    <form method="POST" action="/start/update/{{$start->id}}" enctype="multipart/form-data">
                        @csrf
                        @method("PATCH")

                       <div class="form-group row">
                            <label for="rider_id" class="col-md-4 col-form-label text-md-right">{{ __('Rider licence number') }}</label>
                            <div class="col-md-6">
                                <input id="rider_id" type="text" class="form-control @error('riderid') is-invalid @enderror" name="rider_id" value="{{ $start->rider_id }}" required>

                                @error('rider_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Licence number is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rider_name" class="col-md-4 col-form-label text-md-right">{{ __('Rider name') }}</label>

                            <div class="col-md-6">
                                <input id="rider_name" type="text" class="form-control @error('rider_name') is-invalid @enderror" name="rider_name" value="{{ $start->rider_name }}" required>

                                @error('rider_name')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Rider name is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">
                            <label for="horse_id" class="col-md-4 col-form-label text-md-right">{{ __('Horse licence number') }}</label>

                            <div class="col-md-6">
                                <input id="horse_id" type="text" class="form-control @error('horse_id') is-invalid @enderror" name="horse_id" value="{{ $start->horse_id }}" required>

                                @error('horse_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Licence number is invalid!")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="horse_name" class="col-md-4 col-form-label text-md-right">{{ __('Horse name') }}</label>

                            <div class="col-md-6">
                                <input id="horse_name" type="text" class="form-control @error('horse_name') is-invalid @enderror" name="horse_name" value="{{ $start->horse_name }}" required>

                                @error('horse_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{_("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="club" class="col-md-4 col-form-label text-md-right">{{ __('Club') }}</label>

                            <div class="col-md-6">
                                <input id="club" type="text" class="form-control @error('club') is-invalid @enderror" name="club" value="{{ $start->club}}" required>

                                @error('club')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                            <div class="col-md-6">
                                <input id="category" type="text" class="form-control @error('category') is-invalid @enderror" name="category" value="{{ $start->category }}" required>

                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Invalid category")}}</strong>
                                    </span>
                                @enderror
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
