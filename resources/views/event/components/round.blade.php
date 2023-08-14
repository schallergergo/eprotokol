                        @foreach ($start->jumping_round as $round)
                        @can ('update', $round)
                        <a href="/jumpinground/edit/{{$round->id}}">


                            @if ($round->eliminated1)  {{__("Eliminated!")}}
                            @else 



                            <span title="{{__('Total fault')}}">{{$round->total_fault1}}hp </span> 
                            @if ($round->time_fault1!=0) <span title="{{__('Time fault')}}"> (+{{$round->time_fault1}}) </span>hp @endif - 
                             <span title="{{__('Time')}}"> {{$round->time1}} sec </span> 
                             @endif
                             @if ($round->completed2)
                             <br>
                            @if ($round->eliminated2)  {{__("Eliminated!")}}
                            @else 



                            <span title="{{__('Total fault')}}">{{$round->total_fault2}}hp </span> 
                            @if ($round->time_fault1!=0) <span title="{{__('Time fault')}}"> (+{{$round->time_fault2}}) </span>hp @endif - 
                             <span title="{{__('Time')}}"> {{$round->time1}} sec </span> 
                             @endif


                             @endif



                            

                        </a><br>
                        @else <!-- belongs to can. dont look for the if-->
                        <span class="align-middle">

                          @if ($round->eliminated1)  {{__("Eliminated!")}}
                            @else 



                            <span title="{{__('Total fault')}}">{{$round->total_fault1}}hp </span> 
                            @if ($round->time_fault1!=0) <span title="{{__('Time fault')}}"> (+{{$round->time_fault1}}) </span>hp @endif - 
                             <span title="{{__('Time')}}"> {{$round->time1}} sec </span> 



                            @endif
                            @if ($round->completed2)
                             <br>
                            @if ($round->eliminated2)  {{__("Eliminated!")}}
                            @else 



                            <span title="{{__('Total fault')}}">{{$round->total_fault2}}hp </span> 
                            @if ($round->time_fault1!=0) <span title="{{__('Time fault')}}"> (+{{$round->time_fault2}}) </span>hp @endif - 
                             <span title="{{__('Time')}}"> {{$round->time2}} sec </span> 
                             @endif


                             @endif
                        <br>
                        
                        @endcan
                        @endforeach