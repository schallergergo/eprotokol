@extends('layouts.app')



@section('content')



<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card">





                

                <div class="card-header">

                    <span>{{$event->competition->name}} - {{$event->event_name}} </span>

                    @can ("create",[App\Models\Start::class,$event])

                        <a href="/start/create/{{$event->id}}" >{{__("Add new rider")}}</a>

                    @endcan

                    @can('update',$event)



                        <a href="/event/edit/{{$event->id}}">{{__("Edit event")}}</a>
                         <a href="/event/sort/{{$event->id}}">{{__("Sort")}}</a>
                         @if ($event->has_startlist)
                            <a href="/event/{{$event->id}}/printstartlist">{{__("Printable")}}</a>
                        @endif

                    @endcan

                    <span class="float-right">

                        <a href="/competition/show/{{$event->competition->id}}">

                        {{__("Back")}}

                        </a>

                    </span>

                </div>



                <div class="card-body">



                    @if (count($toStart)!=0)

                    


                   

                   

                    <div class="row mb-2 border">

                        @if ($event->has_startlist)

                        <div class="col-md-1 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("-")}}</span>

                        </div>



                        <div class="col-md-2 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Rider")}}</span>

                        </div>



                        @else
                        <div class="col-md-3 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Rider")}}</span>

                        </div>
                        @endif
                        

                        <div class="col-md-3 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Horse")}}</span>

                        </div>



                        <div class="col-md-2 p-1 border d-none d-md-block ">

                            <span class="align-middle font-weight-bold">{{__("Club")}}</span>

                        </div>



                        <div class="col-md-2 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Category")}}</span>

                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block">

                             <span class="align-middle font-weight-bold">{{__("Options")}}</span>

                        </div>



                    </div><!-- end of the row-->

                    

                    @endif

                    @foreach ($toStart as $start)

                    

                    



                    <div class="row mb-2 border">

                        @if ($event->has_startlist)

                        <div class="col-md-1 p-1 border">

                            <span class="align-middle">{{$start->rank}}). {{substr($start->start_time,0,5)}}</span>

                        </div>

                        <div class="col-md-2 p-1 border">

                            <span class="align-middle">{{$start->rider_name}} ({{$start->rider_id}})</span>

                        </div>


                        @else

                        <div class="col-md-3 p-1 border">

                            <span class="align-middle">{{$start->rider_name}} ({{$start->rider_id}})</span>

                        </div>

                        @endif
                        

                        <div class="col-md-3 p-1 border">

                            <span class="align-middle">{{$start->horse_name}} ({{$start->horse_id}})</span>

                        </div>



                        <div class="col-md-2 p-1 border">

                            <span class="align-middle">{{$start->club}}</span>

                        </div>



                        <div class="col-md-2 p-1 border">

                            <span class="align-middle">{{$start->category}}</span>

                        </div>

        

                        <div class="col-md-2 p-1 border">

                             @can('update',$start)

                            <span class="align-middle"><a href="/start/edit/{{$start->id}}" target="">{{__("Edit info")}}</a></span>

                           
                            <br>

                            @endcan

                            @foreach ($start->result->sortBy('position') as $result)

                            

                            @can('update',$result)



                             <span class="align-middle"><a href="/result/edit/{{$result->id}}" target="">{{$result->position}} {{__("judge")}}</a></span><br>

                            

                             @endcan

                             @endforeach

                             

                              @foreach ($start->jumping_round as $round)

                              @can('update',$round)

                             <span class="align-middle"><a href="/jumpinground/edit/{{$round->id}}" target=""> {{__("Edit rounds")}}</a></span><br>

                             @endcan

                             @endforeach



                              @foreach ($start->style as $style)

                              @can('update',$style)

                             <span class="align-middle"><a href="/style/edit/{{$style->id}}" target="">{{__("Style")}}</a></span><br>

                             @endcan

                             @endforeach



                        </div>

                    </div><!-- end of the row-->



                    @endforeach

                    

                  

                    </div><!-- end of the card-->

                @foreach($startedArray as $started)

                @if (count($started)!=0)

                <div class="card-header-results">{{$started->first()->category}} {{__("results")}}</div>



                <div class="card-body">

                    

                    <div class="row mb-2 border">

                        <div class="col-md-2 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Rider")}}</span>

                        </div>

                        

                        <div class="col-md-2 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Horse")}}</span>

                        </div>



                        <div class="col-md-2 p-1 border d-none d-md-block ">

                            <span class="align-middle font-weight-bold">{{__("Club")}}</span>

                        </div>



                        <div class="col-md-2 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Category")}}</span>

                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block">

                             <span class="align-middle font-weight-bold">{{__("Final result")}}</span>

                            

                        </div>



                        <div class="col-md-2 p-1 border d-none d-md-block">

                             <span class="align-middle font-weight-bold">{{__("Results")}}</span>

                            

                        </div>

                    </div><!-- end of the row-->



                    @foreach ($started as $start)


                    <div class="row mb-3 border">

                        <div class="col-md-2 p-1 border">

                            <span class="align-middle">{{$start->rider_name}} ({{$start->rider_id}})</span>

                        </div>

                        

                        <div class="col-md-2 p-1 border">

                            <span class="align-middle">{{$start->horse_name}} ({{$start->horse_id}})</span>

                        </div>



                        <div class="col-md-2 p-1 border">

                            <span class="align-middle">{{$start->club}}</span>

                        </div>

                        <div class="col-md-2 p-1 border">

                            <span class="align-middle">{{$start->category}}</span>

                        </div>

                    <div class="col-md-2 p-1 border">

                            <span class="align-middle">

                                ({{$start->rank}}.) {{$start->mark}}p  - {{number_format($start->percent,3)}}% @if ($start->collective!=0)- {{$start->collective}}p @endif

                            </span>

                        </div>



                        <div class="col-md-2 p-1 border">

                            @can('update',$start)

                            <span class="align-middle"><a href="/start/edit/{{$start->id}}" target="">{{__("Edit info")}}</a></span>

                            <br>

                            @endcan



                            @include("event.components.result")

                            @include("event.components.round")

                            @include("event.components.style")

                        </div>

                    </div><!-- end of the row-->

                    

                    @endforeach

                    

                    @endif

                    </div><!-- end of the card-->   

                    @endforeach  







@can ("update",$event)

@if (count($notStarted)!=0)

<div class="card-header">

                    <span>Not started</span>

                    

                </div>



                <div class="card-body">



                    

                    

                   

                   

                    <div class="row mb-2 border">

                        <div class="col-md-3 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Rider")}}</span>

                        </div>

                        

                        <div class="col-md-3 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Horse")}}</span>

                        </div>



                        <div class="col-md-2 p-1 border d-none d-md-block ">

                            <span class="align-middle font-weight-bold">{{__("Club")}}</span>

                        </div>



                        <div class="col-md-2 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Category")}}</span>

                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block">

                             <span class="align-middle font-weight-bold">{{__("Options")}}</span>

                        </div>



                    </div><!-- end of the row-->

                    

                    

                    @foreach ($notStarted as $start)

                    

                    



                    <div class="row mb-2 border">

                        <div class="col-md-3 p-1 border">

                            <span class="align-middle">{{$start->rider_name}} ({{$start->rider_id}})</span>

                        </div>

                        

                        <div class="col-md-3 p-1 border">

                            <span class="align-middle">{{$start->horse_name}} ({{$start->horse_id}})</span>

                        </div>



                        <div class="col-md-2 p-1 border">

                            <span class="align-middle">{{$start->club}}</span>

                        </div>



                        <div class="col-md-2 p-1 border">

                            <span class="align-middle">{{$start->category}}</span>

                        </div>

        

                        <div class="col-md-2 p-1 border">

                             @can('update',$start)

                            <span class="align-middle">

                                <a href="{{route('start.notStarted',$start)}}" target="" class = "text-danger">

                            {{__("Started after all")}}</a>

                            </span>

                            <br>

                            @endcan

                            



                        </div>

                    </div><!-- end of the row-->



                    

                    

           @endforeach       

                    </div><!-- end of the card-->





@endif

@endcan



     </div>

    </div>

</div>

</div>

@endsection

