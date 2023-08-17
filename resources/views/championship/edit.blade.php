@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit championship') }}

                    <span class="float-right">
                        <a href="/team/index/{{$championship->id}}">{{__("Teams")}}</a>
                    </span>


                </div>

                <div class="card-body">
                    <form method="POST" action="/championship/update/{{$championship->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')


                       <div class="form-group row">
                            <label for="championshipname" class="col-md-4 col-form-label text-md-right">{{ __('Name of the championship') }}</label>
                            <div class="col-md-6">
                                <input id="championshipname" type="text" class="form-control @error('championshipname') is-invalid @enderror" name="championshipname" value="{{$championship->championshipname}}" required>

                                @error('championshipname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="discipline" class="col-md-4 col-form-label text-md-right">{{ __('Discipline') }}</label>

                            <div class="col-md-6">
                                <select id="discipline"  class="form-control @error('discipline') is-invalid @enderror" name="discipline"  disabled>
                                <option value=""> {{__("Select discipline")}} </option>
                           
                                <option value="poniklub" @if ($championship->discipline=='poniklub') selected @endif> {{__("Pony Club")}} </option>
                                <option value="lovastusa" @if ($championship->discipline=='lovastusa') selected @endif> {{__("Eventing")}} </option>
                                <option value="dijlovas" @if ($championship->discipline=='dijlovas') selected @endif> {{__("Dressage")}} </option>
                             </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <select id="type"  class="form-control @error('type') is-invalid @enderror" name="type"  disabled>
                                <option value=""> {{__("Select type")}} </option>
                           
                                <option value=""  selected > {{$championship->type}} </option>

                             </select>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div><!-- end of the card-->

            <div class="card-header">{{__('Add event') }}</div>

                <div class="card-body">
                    <form method="POST" action="/championship/addEvent/{{$championship->id}}" enctype="multipart/form-data">
                        @csrf



                

                        <div class="form-group row">
                            <label for="discipline" class="col-md-4 col-form-label text-md-right">{{ __('Competitions') }}</label>

                            <div class="col-md-6">
                                <select id="competition"  class="form-control @error('competition') is-invalid @enderror" name="competition">
                                <option value=""> {{__("Select a competition")}} </option>
                                @foreach($competitions as $competition)
                                <option value="{{$competition->id}}" >{{$competition->name}}</option>
                               @endforeach
                             </select>
                            <select id="event"  class="form-control @error('event') is-invalid @enderror" name="event">
                                <option value="">----------- </option>
                                
                             </select>
                            </div>
                        </div>



                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add event') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div><!-- end of the card-->


<div class="card-header">{{__('Remove event') }}</div>

                <div class="card-body">
                      @foreach ($addedEvents as $event)
                <form method="POST" action="/championship/removeEvent/{{$championship->id}}" enctype="multipart/form-data">
                         @csrf
                    <div class="row mb-2 border">
                        <div class="col-md-4 p-1 border d-md-block">
                            <span class="align-middle">{{$event->competition->name}}</span>
                        </div>
                        
                        <div class="col-md-4 p-1 border d-md-block">
                            <span class="align-middle">{{$event->event_name}}</span>
                        </div>
                        <input type="hidden" name="event_id" value="{{$event->id}}">
                        <div class="col-md-4 p-1 border d-md-block">
                            <button type="submit" class="btn btn-primary">
                                    {{ __('Remove') }}
                                </button>
                        </div>
                        
                        
                     
                    </div><!-- end of the row-->
                    </form>                    
                    @endforeach
                   
                       



            



                                

                    
                </div><!-- end of the card-->

            </div>
        </div>
    </div>
</div>
@endsection

@section('footerScript')
<script src="/js/getEventsAjax.js"></script>
@endsection