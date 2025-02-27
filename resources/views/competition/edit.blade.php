@extends('layouts.app')
@section('title',__("Edit competition"))

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit competition') }}
                
                <span>


                   
                    <a href="/competition/sort/{{$competition->id}}">{{__("Sort")}}</a>
                    
                </span>


                <span class="float-right">
                    @if ($competition->active==1)
                    <a href="/competition/updateActive/{{$competition->id}}">{{__("Active competition")}}</a>
                    @else
                    <a href="/competition/updateActive/{{$competition->id}}">{{__("Finished competition")}}</a>
                    @endif
                </span>

                
                </div>

                <div class="card-body">
                    @if ($competition->active==0)
                    <div class="alert alert-danger">{{__("This competition is closed!")}}</div>
                    @endif
                <form method="POST" action="/competition/update/{{$competition->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')



                       <div class="form-group row">
                            <label for="competition_name" class="col-md-4 col-form-label text-md-right">{{ __('Name of the competition') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$competition->name}}" required>

                                @error('competitionname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="venue" class="col-md-4 col-form-label text-md-right">{{ __('Venue') }}</label>

                            <div class="col-md-6">
                                <input id="venue" type="text" class="form-control @error('venue') is-invalid @enderror" name="venue" value="{{$competition->venue}}" required>

                                @error('venue')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div> 
                        </div>



                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{$competition->date}}" required>

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Date is invalid")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Discipline') }}</label>

                            <div class="col-md-6">
                                <select id="descipline"  class="form-control @error('descipline') is-invalid @enderror" name="descipline"  disabled>
                                <option value=""> {{__("Select descipline")}} </option>
                           
                                @if ($competition->discipline=="poniklub")
                                <option selected> {{__("Pony Club")}} </option>
                                @elseif ($competition->discipline=="lovastusa")
                                <option selected> {{__("Eventing")}} </option>
                                @endif
                             </select>
                            </div>
                        </div>

                          <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Broadcast') }}</label>

                            <div class="col-md-6">
                                <select id="broadcast_id"  class="form-control @error('broadcast_id') is-invalid @enderror" name="broadcast_id">
                                <option value=""> {{__("Select event")}} </option>
                           
                                @foreach($events as $event)

                                <option value = "{{$event->id}}"
                                    @if ($competition->broadcast_id == $event->id)selected @endif 
                                    > 
                                    {{$event->event_name}} 
                                </option>

                                @endforeach
                               
                             </select>
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="eventing" class="col-md-4 col-form-label text-md-right">{{ __('Eventing') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" disabled>
                                <option value=""> @if($competition->eventing) {{__('Yes')}} @else {{__('No')}} @endif </option>

                           

                             </select>
                            </div>
                        </div>

                       
 


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
