@extends('layouts.app')
@section('title','Versenyszám hozzáadása')
@section('pagespecificscripts')

    <!-- flot charts css-->
    <script src="{{ asset('js/refresh.js') }}"></script>
@endsection
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create event') }} - {{$competition->name}}</div>

                <div class="card-body">
                    <form method="POST" action="/event/store/{{$competition->id}}" enctype="multipart/form-data">
                        @csrf



                      <div class="form-group row">
                            <label for="event_name" class="col-md-4 col-form-label text-md-right">{{ __('Name of the event') }}</label>
                            <div class="col-md-6">
                                <input id="event_name" type="text" class="form-control @error('event_name') is-invalid @enderror" name="event_name" value="{{ old('event_name') }}" required>

                                @error('event_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                       

                       
 



                        <div class="form-group row">
                            <label for="program" class="col-md-4 col-form-label text-md-right">{{ __('Program') }}</label>

                            <div class="col-md-6">
                                <select id="program_id"  class="form-control @error('program') is-invalid @enderror" name="program_id"  required>
                                <option value=""> {{__("Select a program")}} </option>
                            @foreach ($programs as $program)
                                <option value="{{$program->id}}"> {{$program->name}} </option>
                            @endforeach
                            </select>

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
