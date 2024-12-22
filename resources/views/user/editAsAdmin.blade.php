@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }} 
                    <span><a href="/start/index/{{$user->id}}">{{ __('Results') }}</a></span>
                    <span><a href="/home">{{ __('Home') }}</a></span>
                    <span>{{$clubByStart}}</span>
                    <span class="float-right"><a href="/user/delete/{{$user->id}}">{{__("Delete")}}</a></span>
                    </div>
                    
                    


                <div class="card-body">
                    <form method="POST" action="/user/updateAsAdmin/{{$user->id}}">
                        @csrf
                        @method("patch")
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Licence number') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username}}">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ __("Already taken.") }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                            <div class="col-md-6">
                                <select id="role"  class="form-control @error('role') is-invalid @enderror" name="role"  required>
                                
                                <option value=""> {{_("Select role")}} </option>
                                <option value="rider"   @if ($user->role=="rider") selected @endif> {{__("Rider")}} </option>
                                <option value="club"   @if ($user->role=="club") selected @endif> {{__("Club")}} </option>
                                <option value="office"   @if ($user->role=="office") selected @endif> {{__("Office")}} </option>
                                <option value="penciler"   @if ($user->role=="penciler") selected @endif> {{__("Penciler")}} </option>

                             </select>

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ "no bueno" }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="club" class="col-md-4 col-form-label text-md-right">{{ __('Club') }}</label>
                            <div class="col-md-6">
                                <select id="club"  class="form-control @error('club') is-invalid @enderror" name="club"  required>
                                <option value="0"> {{__("Individual")}} </option>
                                @foreach ($clubs as $club)
                                <option value="{{$club->id}}" @if ($user->club==$club->id) selected @endif> {{$club->name}}  </option>
                                @endforeach
                             </select>

                                @error('club')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ "no bueno" }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email_verified_at" class="col-md-4 col-form-label text-md-right">{{ __('Email verified') }}</label>
                            <div class="col-md-6">
                                <input type="datetime-local" name="email_verified_at" class="form-control @error('email') is-invalid @enderror" value="{{$user->email_verified_at}}">
                                @error('email_verified_at')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ "no bueno" }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
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
