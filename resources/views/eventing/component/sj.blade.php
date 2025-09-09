



        @can("update",$eventing_cross)

        

            @if ($eventing_sj->eliminated)

            

            <span class="align-middle"><a href="/eventing/showjumping/edit/{{$eventing_sj->id}}">

                {{__("Eliminated")}}

                </a></span>

            @elseif ($eventing_sj->completed)

            <span class="align-middle"><a href="/eventing/showjumping/edit/{{$eventing_sj->id}}">

                {{$eventing_sj->total_fault}} hp @if($eventing_sj->time_fault!=0)(+{{$eventing_sj->time_fault}}) @endif-

                {{$eventing_sj->time}}</a></span>

            

            @else

            <span class="align-middle"><a href="/eventing/showjumping/edit/{{$eventing_sj->id}}">{{__("Show jumping")}}</a></span>

            @endif



        @else

             @if ($eventing_sj->eliminated)

            

            <span class="align-middle">

                {{__("Eliminated")}}

                </span>

             @elseif ($eventing_sj->completed)

            <span class="align-middle">

                {{$eventing_sj->total_fault}} hp @if($eventing_sj->time_fault!=0)(+{{$eventing_sj->time_fault}}) @endif-

                {{$eventing_sj->time}}

            </span>

            @endif

        @endcan

