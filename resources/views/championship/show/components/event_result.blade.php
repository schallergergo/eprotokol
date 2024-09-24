
                        
                    
                        @foreach ($team_result["competition_results"] as $competition_result)


                            <div class="row mb-2 ">
                        


                        
                        <div class="col-md-4 p-1 border">
                            <span class="align-middle font-weight-bold">{{$competition_result["competition"]->date}}</span>
                        </div>


                        <div class="col-md-4 p-1 border">
                            <span class="align-middle font-weight-bold">{{$competition_result["competition"]->name}}</span>
                        </div>

                        <div class="col-md-4 p-1 border">
                            <span class="align-middle font-weight-bold">{{__("Average")}}:       {{ number_format($competition_result["best_two"], 3) }} %</span>
                        </div>

                       
                        
                    </div><!-- end of the row-->
                    
 
                        @foreach($competition_result["starts"] as $start)
                        <div class="row mb-2 ">
                        
                                <div class="col-md-1 p-1">
                                    
                                </div>

                                 <div class="col-md-3 p-1 border">
                                    <span class="align-middle">{{$start->event->event_name}} </span>
                                </div>

                                
                                <div class="col-md-3 p-1 border">
                                    <span class="align-middle">{{$start->rider_name}} ( {{$start->rider_id}} )  </span>
                                </div>

                                <div class="col-md-3 p-1 border">
                                    <span class="align-middle">{{$start->horse_name}} ( {{$start->horse_id}} )</span>
                                </div>


                                <div class="col-md-2 p-1 border">
                                    <span class="align-middle">{{$start->mark}} p - {{$start->percent}} %</span>
                                </div>
        
                        
                        </div><!-- end of the row-->
                        @endforeach <!-- end foreach starts-->

                        @endforeach  <!-- end foreach eventresults-->


                        