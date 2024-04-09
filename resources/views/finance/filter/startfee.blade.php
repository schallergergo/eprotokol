<div class="card">


                
                <div class="card-header">
                    <span>{{$competition->name}} {{$filterTerm}} {{__("finance")}} </span>
                    {{__("Amount")}} : <span id="startFeeTotal" class="ml-2 text-info"></span>


                    
                    <span class="float-right">
                        <a href="/finance/show/{{$competition->id}}">
                        {{__("Back")}}
                        </a>
                    </span>
                </div>

                <div class="card-body">
                <form id="startFeeForm" method="post" action="{{route('transaction.create',$competition)}}">
                   @csrf
                    <input type="hidden" name="fee_type" value ="startfee">
                   
                   
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
                            <span class="align-middle font-weight-bold">{{__("Event")}}</span>
                        </div>
                        <div class="col-md-2 p-1 border d-none d-md-block">
                             <span class="align-middle font-weight-bold">

                             	{{__("Amount")}}
                             	<input type="checkbox" id="checkAllStart"> (+/-)

                             </span>

                        </div>

                    </div><!-- end of the row-->
                    

                    @foreach ($start_fees as $fee)
                    
                    

                    <div class="row mb-2 border">
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$fee->start->rider_name}}</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border">
                            <span class="align-middle">{{$fee->start->horse_name}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$fee->start->club}}</span>
                        </div>

                        <div class="col-md-2 p-1 border">
                            <span class="align-middle">{{$fee->start->event->event_name}}</span>
                        </div>
        
                        <div class="col-md-2 p-1 border">
                            @if ($fee->paid)
                            {{$fee->amount}} {{__('paid')}}
                            <a href="{{route('transaction.show',$fee->transaction)}}">
                                

                             {{__("Show transaction")}} </a>

                            @else
                            <label >
                        	<input type="checkbox" name="startfee[]" value="{{$fee->id}}">
                        	{{$fee->amount}}
                        	</label>

                            @endif
                        </div>
                    </div><!-- end of the row-->

                    @endforeach
                    
                    <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>

                            <div class="col-md-6">
                                <textarea id="comment" class="form-control " name="comment">{{$filterTerm}}
                                </textarea>

                                
                            </div>
                        </div>
                        <div class="col-md-6 offset-md-4">
                  	<input type="submit" name="submit" value="submit" class="btn btn-primary"class="btn btn-primary">
                  </div>
                    </form>
                    </div><!-- end of the card-->
               


     </div>
    </div>