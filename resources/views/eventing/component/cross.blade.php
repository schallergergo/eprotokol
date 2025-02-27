

        @can("update",$eventing_cross)
            @if ($eventing_cross->completed)
            <span class="align-middle"><a href="/eventing/cross/edit/{{$eventing_cross->id}}">
                {{$eventing_cross->total_fault}} hp @if($eventing_cross->time_fault!=0)(+{{$eventing_cross->time_fault}}) @endif-
                {{$eventing_cross->time}}</a></span>
            @else
            <span class="align-middle"><a href="/eventing/cross/edit/{{$eventing_cross->id}}">{{__("Cross")}}</a></span>
            @endif

        @else
             @if ($eventing_cross->completed)
            <span class="align-middle">
                {{$eventing_cross->total_fault}} hp @if($eventing_cross->time_fault!=0)(+{{$eventing_cross->time_fault}}) @endif-
                {{$eventing_cross->time}}
            </span>
            @endif
        @endcan
