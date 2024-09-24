@extends('layouts.app')



@section('content')



<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header">{{ __('Championship') }} {{$championship->championshipname}}



                    @can('create',[App\Models\Team::class,$championship])

                    <span class="ml-2"><a href="/team/create/{{$championship->id}}">{{__("Create team")}}</a></span>

                    

                    @endcan
                    <span class="ml-2 float-right"><a href="/championship/edit/{{$championship->id}}">{{__("Back")}}</a></span>
                    

                     

                </div>



                <div class="card-body">



                    <div class="row mb-2 border">

                        <div class="col-md-4 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Team name")}}</span>

                        </div>

                        



                        <div class="col-md-4 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Team options")}}</span>

                        </div>



                        <div class="col-md-4 p-1 border d-none d-md-block">

                             <span class="align-middle font-weight-bold">{{__("Options")}}</span>

                            

                        </div>

                    </div><!-- end of the row-->

                    @foreach ($teams as $team)

                        <div class="row mb-2 border">

                        <div class="col-md-4 p-1 border">

                            <span class="align-middle ">{{$team->name}}</span>

                        </div>

                        



                        <div class="col-md-4 p-1 border">

                            <span class="align-middle "><a href="/team/edit/{{$team->id}}">{{__("Edit team")}}</a></span>

                        </div>

                      



                        <div class="col-md-4 p-1 border">

                            @foreach ($team->team_member as $member)



                                    <span class="align-middle">

                                        {{$member->rider_name}} - {{$member->horse_name}} - <a href="/team_member/delete/{{$member->id}}">  {{__("Remove")}}</a><br>

                                    </span>

                             @endforeach                          

                             @if (count($team->team_member)<3)

                                <a href="/team_member/create/{{$team->id}}">  {{__("Add team member")}}</a>

                             @endif

                            

                        </div>



                    </div><!-- end of the row-->

                    

                    @endforeach

                    

                   

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

