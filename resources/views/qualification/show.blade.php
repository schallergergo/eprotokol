@extends('layouts.app')



@section('content')



<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">{{ __('Qualification') }} {{count($starts)}}</div>



                <div class="card-body">



                    <div class="row mb-2 border">





                        <div class="col-md-4 p-1 border d-none d-md-block ">

                            <span class="align-middle font-weight-bold">{{__("Rider")}}</span>

                        </div>



                        <div class="col-md-4 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Horse")}}</span>

                        </div>

                        <div class="col-md-4 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Result")}}</span>

                        </div>

        

                    </div><!-- end of the row-->



                    @foreach ($starts as $start)

                    <div class="row mb-2 border">

                       

                        <div class="col-md-4 p-1 border">

                            <span class="align-middle">{{$start->rider_name}} ( {{$start->rider_id}} )</span>

                        </div>



                        <div class="col-md-4 p-1 border">

                            <span class="align-middle">{{$start->horse_name}} ( {{$start->horse_id}} )</span>

                        </div>

                        <div class="col-md-4 p-1 border">

                            @if ($start->eliminated)

                                <span class="aalign-middle">{{__("Eliminated")}}</span>

                            @else

                                <span class="align-middle">{{$start->mark}} {{__("points")}} - {{number_format($start->percent,2)}}%</span>

                            @endif

                        </div>



                      

                    </div><!-- end of the row-->

                    

                    @endforeach

                    

                 

                    </div><!-- end of the row-->

                   

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

