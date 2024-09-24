
@extends('layouts.app')



@section('content')



<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card">





                

                <div class="card-header">

                    <span>{{__("Finance")}} </span>

                    <span><a href="/transaction/index/{{$competition->id}}">{{__("Transactions")}}</a></span>

                     <span><a href="/finance/didnotpay/competition/{{$competition->id}}">{{__("Did not pay")}}</a></span>

                     <span><a href="/boxfee/index/{{$competition->id}}">{{__("Box fees")}}</a></span>

                        	

 					


 					<span class ="ml-4-1">  {{__("Start total")}} : {{$totalStartFee}}  </span>


 					<span class ="ml-1">  {{__("Box total")}} : {{$totalBoxFee}}  </span>
                       

                    

                  
                    <span class="float-right">

                        <a href="/competition/show/{{$competition->id}}">

                        {{__("Back")}}

                        </a>

                    </span>

                </div>



                <div class="card-body">



                  

                    

                   

                   

                    <div class="row mb-2 border">

                        <div class="col-md-4 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Club")}}</span>

                        </div>

                        

                        <div class="col-md-4 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Payed amount")}}</span>

                        </div>




                        <div class="col-md-4 p-1 border d-none d-md-block">

                             <span class="align-middle font-weight-bold">{{__("Options")}}</span>

                        </div>



                    </div><!-- end of the row-->

                    



                    @foreach ($clubsArray as $club)

                    

                    



                    <div class="row mb-2 border">

                        <div class="col-md-4 p-1 border">

                            <span class="align-middle">{{$club["club_name"]}}</span>

                        </div>

                        

                        <div class="col-md-4 p-1 border">

                            <span class="align-middle">


                            	{{__("Start fee")}} : {{$club["start_fee"]}} <br>


                            	{{__("Box fee")}} : {{$club["box_fee"]}}


                            </span>

                        </div>
        

                        <div class="col-md-4 p-1 border">


                              <a href="/finance/filter/competition/{{$competition->id}}/filter/{{$club['club_name']}}">{{__("Show")}}</a>

                        </div>

                    </div><!-- end of the row-->



                    @endforeach

                    

                  

                    </div><!-- end of the card-->


     </div>

    </div>

</div>

</div>

@endsection



