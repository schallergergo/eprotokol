@extends('layouts.app')

@section('title',__("Edit event"))

@section('content')





<div class="container">

    @if (session('status'))

    <div class="alert alert-success">

        {{ session('status') }}

    </div>

    @endif

    <div class="row justify-content-center">

        <div class="col-md-10">

            <div class="card">

                
                @include("event.edit.editEvent")

                @include("event.edit.startlist")

                @include("event.edit.officials")

                @include("event.edit.competitors")

                @include("event.edit.categories")




                

            </div>

        </div>

    </div>

</div>



@endsection

