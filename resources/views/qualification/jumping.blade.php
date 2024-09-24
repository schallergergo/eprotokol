@extends('layouts.app')
 @section('content') 
 <div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">

    <!-- Include the qualification card component and pass the kezdok variable -->
    @component('components.jumpingqualification', ['qualifications' => $elokezdok,"name"=>"Előkezdő stílus"])
    @endcomponent

    <!-- Include the qualification card component and pass the kezdok variable -->
    @component('components.jumpingqualification', ['qualifications' => $kezdok,"name"=>"Kezdő"])
    @endcomponent

    <!-- Include the qualification card component and pass the kezdok variable -->
    @component('components.jumpingqualification', ['qualifications' => $haladostilus,"name"=>"Haladó stílus"])
    @endcomponent

    <!-- Include the qualification card component and pass the kezdok variable -->
    @component('components.jumpingqualification', ['qualifications' => $haladok,"name"=>"Haladó"])
    @endcomponent



    </div>
  </div>
</div>

@endsection