                        @foreach ($start->result->sortBy('position') as $result)
                        @can ('checkAfter', $result)
                        <a href="/result/show/{{$result->id}}">


                            @if ($result->eliminated) {{__("Eliminated!")}}
                            @else 


                             <span title="{{__('Judge')}}">{{$result->position}}: </span>
                            <span title="{{__('Point')}}">{{$result->mark}}p </span> - 
                             <span title="{{__('Percentage')}}">{{$result->percent}}% </span> - 
                             <span title="{{__('Collective mark')}}">{{$start->collective}}p </span>


                            @endif

                        </a><br>
                        @else <!-- belongs to can. dont look for the if-->
                        <span class="align-middle">

                         @if ($result->eliminated) {{__("Eliminated!")}}
                       @else <span title="{{__('Judge')}}">{{$result->position}}: </span>
                             <span title="{{__('Point')}}">{{$result->mark}}p </span> - 
                             <span title="{{__('Percentage')}}">{{$result->percent}}% </span> - 
                             <span title="{{__('Collective mark')}}">{{$start->collective}}p </span>

                        @endif</span>
                        <br>
                        
                        @endcan
                        @endforeach