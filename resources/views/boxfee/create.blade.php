@extends('layouts.app')
@section('title','Versenyzők hozzáadása')
@section('content')


<div class="container">
     @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    
    <div class="row justify-content-center">
        <div class="col-md-8">

            
            <div class="card mb-2">
                <div class="card-header">{{ __('Import box fee') }} 


                    <span class="float-right"><a href="/files/box_template.xlsx">{{__("Import template")}}</a></span>


                </div>

                <div class="card-body">
                    <form method="POST" action="/boxfee/import/{{$competition->id}}" enctype="multipart/form-data">
                        @csrf
                       
                        <input type="file" name="importFile">


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Import') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

           
            <div class="card">
                <div class="card-header">{{ __('Add new start') }}</div>

                <div class="card-body">
                    <form method="POST" action="/boxfee/store/{{$competition->id}}" enctype="multipart/form-data">
                        @csrf
                       

                       <div class="form-group row">
                            <label for="rider_id" class="col-md-4 col-form-label text-md-right">{{ __('Rider licence number') }}</label>
                            <div class="col-md-6">
                                <input id="rider_id" type="text" class="form-control @error('rider_id') is-invalid @enderror" name="rider_id" value="{{ old('rider_id') }}" required>

                                @error('rider_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Licence number is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rider_name" class="col-md-4 col-form-label text-md-right">{{ __('Rider name') }} 
                                <a href="#" id="findRiderName" onclick="fillRider()"></a> 
                                <a href="#" id="findRiderId" onclick="fillRider()"></a>
                                <span id="findRiderClub"  hidden></span>

                            </label>


                            <div class="col-md-6">
                                <input id="rider_name" type="text" class="form-control @error('rider_name') is-invalid @enderror" name="rider_name" value="{{ old('rider_name') }}" required>

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
                                <input id="horse_id" type="text" class="form-control @error('horse_id') is-invalid @enderror" name="horse_id" value="{{ old('horse_id') }}" required>

                                @error('horse_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Licence number is invalid!")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="horse_name" class="col-md-4 col-form-label text-md-right">{{ __('Horse name') }}

                                <a href="#" id="findHorseName" onclick="fillHorse()"></a> 
                                <a href="#" id="findHorseId" onclick="fillHorse()"></a>

                            </label>

                            <div class="col-md-6">
                                <input id="horse_name" type="text" class="form-control @error('horse_name') is-invalid @enderror" name="horse_name" value="{{ old('horse_name') }}" required>

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
                                <input id="club" type="text" class="form-control @error('club') is-invalid @enderror" name="club" value="{{ old('club') }}" required>

                                @error('club')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required>

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Invalid amount")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('New box fee') }}
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
