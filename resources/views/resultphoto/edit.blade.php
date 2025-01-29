@extends('layouts.app')
@section('title',__("Edit result photo"))

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            


                @include("resultphoto.edit.result_update")
                @include("resultphoto.edit.photo")

            </div>
        </div>
    </div>
</div>
@endsection
