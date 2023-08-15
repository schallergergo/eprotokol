@extends('layouts.app')
@section('title','Bajnokság hozzáadása')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create championship') }}</div>

                <div class="card-body">
                    <form method="POST" action="/championship/store" enctype="multipart/form-data">
                        @csrf



                       <div class="form-group row">
                            <label for="championshipname" class="col-md-4 col-form-label text-md-right">{{ __('Name of the championship') }}</label>
                            <div class="col-md-6">
                                <input id="championshipname" type="text" class="form-control @error('championshipname') is-invalid @enderror" name="championshipname" value="{{ old('championshipname') }}" required>

                                @error('championshipname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select id="type"  class="form-control @error('type') is-invalid @enderror" name="type"  required>
                                <option value=""> {{__("Select type")}} </option>
                           
                                <option value="pkdressage"> {{__("Pony Club Dressage")}} </option>
                                <option value="pkshowjumping"> {{__("Pony Club Show Jumping")}} </option>

                             </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="discipline" class="col-md-4 col-form-label text-md-right">{{ __('Discipline') }}</label>

                            <div class="col-md-6">
                                <select id="discipline"  class="form-control @error('discipline') is-invalid @enderror" name="discipline"  required>
                                <option value=""> {{__("Select discipline")}} </option>
                           
                                <option value="poniklub"> {{__("Pony Club")}} </option>
                                <option value="lovastusa"> {{__("Eventing")}} </option>
                                <option value="dijlovas"> {{__("Dressage")}} </option>
                             </select>
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('New championship') }}
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


