@extends('layouts.app')


@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create team') }}</div>

                <div class="card-body">
                    <form method="POST" action="/team_member/store/{{$team->id}}" enctype="multipart/form-data">
                        @csrf




                        @for ($i=0;$i<3-$memberCount;$i++)

                        <div class="form-group row">
                            <label for="rider[]" class="col-md-4 col-form-label text-md-right">{{ __('Rider id') }}</label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control @error('rider[]') is-invalid @enderror" name="rider[]" value="{{ old('rider[]') }}" >

                                @error('rider[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="horse[]" class="col-md-4 col-form-label text-md-right">{{ __('Horse id') }}</label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control @error('horse[]') is-invalid @enderror" name="horse[]" value="{{ old('horse[]') }}">

                                @error('horse[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        @endfor




                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
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


