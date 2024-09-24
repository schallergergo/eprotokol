                        @foreach ($start->style as $style)
                        @can ('update', $style)
                        <a href="/style/edit/{{$style->id}}">


                            @if ($style->eliminated)  {{__("Eliminated!")}}
                            @else 



                            <span title="{{__('Given mark')}}">{{$style->given_mark}} </span> 
                            @if ($style->deductions!=0) <span title="{{__('Deductions')}}"> (-{{$style->deductions}}) = {{$style->total_mark}} </span> @endif p - 
                             <span title="{{__('Time')}}"> {{$style->time}} sec </span> 
                             @endif




                            

                        </a><br>
                        @else <!-- belongs to can. dont look for the if-->
                        <span class="align-middle">

                          @if ($style->eliminated1)  {{__("Eliminated!")}}
                            @else 


                            <span title="{{__('Given mark')}}">{{$style->given_mark}} </span> 
                            @if ($style->deductions!=0) <span title="{{__('Deductions')}}"> (-{{$style->deductions}}) = {{$style->total_mark}} </span> @endif p - 
                             <span title="{{__('Time')}}"> {{$style->time}} sec </span> 
                             @endif





                        <br>
                        
                        @endcan
                        @endforeach