@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add new block') }} - {{$program->name}}</div>

                <div class="card-body">
                    <form method="POST" action="/block/store/{{$program->id}}" enctype="multipart/form-data">
                        @csrf
                        
                        


                        <div class="form-group row">
                            <label for="ordinal" class="col-md-4 col-form-label text-md-right">{{ __('Ordinal') }}</label>

                            <div class="col-md-6">
                                <input id="ordinal" type="number" class="form-control @error('ordinal') is-invalid @enderror" name="ordinal" value="{{$ordinal}}" required>

                                @error('ordinal')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                         <div class="form-group row">
                            <label for="programpart" class="col-md-4 col-form-label text-md-right">{{ __('Program part') }}</label>
                            <div class="col-md-6">
                               <select id="programpart"  class="form-control @error('program') is-invalid @enderror" name="programpart"  required>
                                <option value=""> {{__("Program part")}} </option>
                                <option value="1"> {{__("Blocks")}} </option>
                                <option value="2"> {{__("Collective marks")}} </option>
                            
                            </select required>

                                @error('programpart')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="letters" class="col-md-4 col-form-label text-md-right">{{ __('Letters') }}</label>

                            <div class="col-md-6">
                                <textarea id="letters" class="form-control @error('letters') is-invalid @enderror" name="letters" value="normal" required></textarea>

                                @error('letters')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                         <div class="form-group row">
                            <label for="criteria" class="col-md-4 col-form-label text-md-right">{{ __('Criteria') }}</label>

                            <div class="col-md-6">
                                <textarea id="criteria" class="form-control @error('criteria') is-invalid @enderror" name="criteria" value="normal" required></textarea>

                                @error('criteria')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                         <div class="form-group row">
                            <label for="maxmark" class="col-md-4 col-form-label text-md-right">{{ __('Max mark') }}</label>

                            <div class="col-md-6">
                                <input id="maxmark" type="number" class="form-control @error('maxmark') is-invalid @enderror" name="maxmark" value="10" required>

                                @error('maxmark')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>

                        <div class="form-group row">
                            <label for="coefficient" class="col-md-4 col-form-label text-md-right">{{ __('Coefficient') }}</label>

                            <div class="col-md-6">
                                <input id="coefficient" type="number" class="form-control @error('coefficient') is-invalid @enderror" name="coefficient" value="1" required>

                                @error('coefficient')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Field is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>


                    

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add block') }}
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
