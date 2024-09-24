



@extends('layouts.app')



@section('content')



<div class="container">

    <div class="row justify-content-center">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="col-md-12">

            @include("finance.filter.startfee")



</div>

</div>





@endsection

@section('pagespecificscripts')



    <script src="{{ asset('js/financeSum.js') }}"></script>



@endsection

