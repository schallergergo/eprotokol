
        <div class="card-header"><span class="align-middle">{{ __('Officials') }} </span>

            <span class="align-middle"><a href="/official/create/{{$event->id}}">{{__("New official")}}</a>

            </span>
        </div>

                <div class="card-body">

                   

 

                    <div class="row mb-2 border">

                        <div class="col-md-3 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Judge")}}</span>

                        </div>

                        

                        <div class="col-md-3 p-1 border d-none d-md-block">

                            <span class="align-middle font-weight-bold">{{__("Penciler")}}</span>

                        </div>



                        <div class="col-md-3 p-1 border d-none d-md-block ">

                            <span class="align-middle font-weight-bold">{{__("Position")}}</span>

                        </div>

                        



                        <div class="col-md-3 p-1 border d-none d-md-block">

                             <span class="align-middle font-weight-bold">{{__("Options")}}</span>

                            

                        </div>

                    </div><!-- end of the row-->

                    @foreach($officials as $official)

                    <div class="row mb-2 border">

                        <div class="col-md-3 p-1 border  d-md-block">

                            <span class="align-middle">{{$official->judge}}</span>

                        </div>

                        

                        <div class="col-md-3 p-1 border  d-md-block">

                            <span class="align-middle">{{$official->user->name}}</span>

                        </div>



                        <div class="col-md-3 p-1 border d-md-block ">

                            <span class="align-middle">{{$official->position}} {{__("judge")}}</span>

                        </div>

                        



                        <div class="col-md-3 p-1 border d-md-block">

                             <span class="align-middle">

                                <a href="/official/edit/{{$official->id}}" target="_blank">{{__("Edit")}}

                                </a>

                                </span>

                                 <span class="align-middle">

                                <a href="/official/delete/{{$official->id}}">{{__("Delete")}}

                                </a>

                            </span>

                            

                        </div>

                    </div><!-- end of the row-->

                    @endforeach

                



                 

                </div>

