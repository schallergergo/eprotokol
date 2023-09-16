@extends('layouts.app')



@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">{{ __('Dashboard') }}</div>



                <div class="card-body">

                    @if (session('status'))

                        <div class="alert alert-success" role="alert">

                            {{ session('status') }}

                        </div>

                    @endif

                        <form method="POST" action="/user/search/" enctype="multipart/form-data">
                        @csrf
                      <div class="form-group row">
                            <div class="col-md-6">
                                <input id="search" type="text" class="form-control @error('search') is-invalid @enderror" name="search" value="{{ old('search') }}"    
                                placeholder="{{__('Search')}}">

                                @error('search')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6 ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Search') }}
                                </button>
                            </div>
                        </div>

                        </form>

                    @foreach ($users as $user)

                    <p>

                        <span>{{$user->name}} - {{$user->username}} - {{$user->email}} -  {{$user->club}} - {{$user->role}}</span>

                        <a href="/user/edit/{{$user->id}}">{{__("Edit")}}</a>

                        <a href="/admin/login/{{$user->id}}">{{__("Login as user")}}</a>

                    </p>

                    @endforeach



                     <div class="row">

                        <div class="col-md-12 mt-2">

                       {{ $users->links() }}

                        </div>

                       

                    </div><!-- end of the row-->

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

