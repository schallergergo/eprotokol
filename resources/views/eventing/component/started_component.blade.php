  
@foreach ($starts_in_category as $starts)
  <div class="card">


                <div class="card-header">

                    <span>{{$starts->first()->category}} </span>

                </div>



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



                        <div class="col-md-1 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Category")}}</span>

                        </div>

                        <div class="col-md-2 p-1 border d-none d-md-block">

                             <span class="align-middle font-weight-bold">{{__("Dressage")}}</span>

                        </div>

                        <div class="col-md-1 p-1 border d-none d-md-block">

                             <span class="align-middle font-weight-bold">{{__("Cross")}}</span>

                        </div>

                        <div class="col-md-1 p-1 border d-none d-md-block">

                             <span class="align-middle font-weight-bold">{{__("Show Jumping")}}</span>

                        </div>

                        <div class="col-md-1 p-1 border d-none d-md-block">

                             <span class="align-middle font-weight-bold">{{__("Total faults")}}</span>

                        </div>



                    </div><!-- end of the row-->

                    

                




                    
                    @foreach($starts as $start)

                    <div class="row mb-2 border">

                        <div class="col-md-2 p-1 border d-md-block">

                            <span class="align-middle">{{$start->rider_name}} ({{$start->rider_id}})</span>

                        </div>



                       <div class="col-md-2 p-1 border d-md-block">

                            <span class="align-middle">{{$start->horse_name}} ({{$start->horse_id}})</span>

                        </div>


                        <div class="col-md-2 p-1 border d-md-block ">

                            <span class="align-middle">{{$start->club}}</span>

                        </div>



                        <div class="col-md-1 p-1 border d-md-block">

                            <span class="align-middle">{{$start->category}}</span>

                        </div>

                        <div class="col-md-2 p-1 border d-md-block">

                             <span class="align-middle">

                            @can('update',$start)

                            <span class="align-middle"><a href="/start/edit/{{$start->id}}" target="">{{__("Edit info")}}</a></span>

                            <br>

                            @endcan

                            @if ($start->completed)

                            @include("event.components.result")

                            @else
                            

                            @include("eventing.component.result")


                            @endif

                                 </span>

                            @php
                            $eventing = $start->eventing;
                            $eventing_cross = $start->eventing_cross;
                            $eventing_sj = $start->eventing_show_jumping;
                            @endphp

                        </div>

                        <div class="col-md-1 p-1 border d-md-block">

                            @include("eventing.component.cross")
                        </div>

                        <div class="col-md-1 p-1 border d-md-block">

                            @include("eventing.component.sj")

                        </div>

                        <div class="col-md-1 p-1 border d-md-block">

                            @if($eventing->completed_count>0)
                             <span class="align-middle">{{$eventing->fault}}</span>
                             @endif
                        </div>


                    </div><!-- end of the row-->



                    @endforeach

                    



                </div>
                

            </div>

            @endforeach