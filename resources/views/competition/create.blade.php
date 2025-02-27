@extends('layouts.app')
@section('title','Verseny hozzáadása')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create competition') }}</div>

                <div class="card-body">
                    <form method="POST" action="/competition/store" enctype="multipart/form-data">
                        @csrf



                       <div class="form-group row">
                            <label for="competition_name" class="col-md-4 col-form-label text-md-right">{{ __('Name of the competition') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required>

                                @error('competitionname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="venue" class="col-md-4 col-form-label text-md-right">{{ __('Venue') }}</label>

                            <div class="col-md-6">
                                <input id="venue" type="text" class="form-control @error('venue') is-invalid @enderror" name="venue" value="{{ old('venue') }}" required>

                                @error('venue')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>



                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Date is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Discipline') }}</label>

                            <div class="col-md-6">
                                <select id="discipline"  class="form-control @error('discipline') is-invalid @enderror" name="discipline"  required>
                                <option value=""> {{__("Select discipline")}} </option>
                           
                                <option value="poniklub"> {{__("Pony Club")}} </option>
                                <option value="lovastusa"> {{__("Eventing")}} </option>
                                <option value="dijlovas"> {{__("Dressage")}} </option>
                             </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="eventing" class="col-md-4 col-form-label text-md-right">{{ __('Eventing') }}</label>

                            <div class="col-md-6">
                                <select id="eventing"  class="form-control @error('eventing') is-invalid @enderror" name="eventing"  required>
                                <option value="0"> {{__("No")}} </option>
                                <option value="1"> {{__("Yes")}} </option>
                           

                             </select>
                            </div>
                        </div>


                       
 


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('New competition') }}
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
