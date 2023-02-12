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
