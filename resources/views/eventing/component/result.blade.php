                            @foreach ($start->result->sortBy('position') as $result)

                            

                            @can('update',$result)



                             <span class="align-middle"><a href="/result/edit/{{$result->id}}" target="">{{$result->position}} {{__("judge")}}</a></span><br>

                            

                             @endcan

                             @endforeach