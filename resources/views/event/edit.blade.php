@extends('layouts.app')
@section('title',__("Edit event"))
@section('content')


<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit event') }}
                    <span class="float-right"><a href="/event/show/{{$event->id}}">{{__("Back to event")}}</a></span>
                </div>

                <div class="card-body">
                    <form method="POST" action="/event/update/{{$event->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')


                    
                        
                      <div class="form-group row">
                            <label for="event_name" class="col-md-4 col-form-label text-md-right">{{ __('Name of the event') }}</label>
                            <div class="col-md-6">
                                <input id="event_name" type="text" class="form-control @error('event_name') is-invalid @enderror" name="event_name" value="{{ $event->event_name }}" required>

                                @error('event_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="program" class="col-md-4 col-form-label text-md-right">{{ __('Program') }}</label>

                            <div class="col-md-6">
                                <select id="program_id"  class="form-control @error('program') is-invalid @enderror" name="program_id"  disabled>
                                <option value=""> {{__("Select a program")}} </option>
                            @foreach ($programs as $program)
                            @if ($event->program_id==$program->id)
                                <option selected> {{$program->name}} </option>
                            @endif
                            @endforeach
                            </select>

                            </div>
                        </div>

                         
                        <div class="form-group row">
                            <label for="sponsor" class="col-md-4 col-form-label text-md-right">{{ __('Sponsor') }}</label>

                            <div class="col-md-6">
                                <select id="sponsor_id"  class="form-control @error('sponsor') is-invalid @enderror" name="sponsor_id"  required>
                                <option value=""> {{__("Select a sponsor")}} </option>
                            @foreach ($sponsors as $sponsor)
                                <option value="{{$sponsor->id}}" @if ($event->sponsor_id==$sponsor->id) selected @endif > {{$sponsor->name}} </option>
                            @endforeach
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
                    </div>


        <div class="card-header"><span class="align-middle">{{ __('Officials') }} </span>
            <span class="align-middle"><a href="/official/create/{{$event->id}}">{{__("New official")}}</a>
            </span></div>
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
                        <div class="col-md-3 p-1 border d-none d-md-block">
                            <span class="align-middle">{{$official->judge}}</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border d-none d-md-block">
                            <span class="align-middle">{{$official->user->name}}</span>
                        </div>

                        <div class="col-md-3 p-1 border d-none d-md-block ">
                            <span class="align-middle">{{$official->position}} {{__("judge")}}</span>
                        </div>
                        

                        <div class="col-md-3 p-1 border d-none d-md-block">
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





                <div class="card-header">
                    {{ __('Add competitors') }}
                    <a href="/files/result_template.xlsx">{{__("Import template")}}</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="/start/import/{{$event->id}}" enctype="multipart/form-data">
                        @csrf
                       <div class="form-group row">
                            <label for="upload" class="col-md-4 col-form-label text-md-right">{{ __('Upload') }}</label>
                            <div class="col-md-6">
                                <input id="upload" type="file" class="form-control @error('upload') is-invalid @enderror" name="upload" required>

                                @error('upload')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Invalid format")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                      

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __("Upload") }}
                                </button>
                            </div>
                        </div>

                        
                    </form>
                </div> <!-- end of card-->


               


                 <div class="card-header">
                    {{ __('Edit category') }}
                    <a href="/event/resetCategory/{{$event->id}}">{{__("Reset category")}}</a>
                </div>
                <div class="card-body">
                    <form method="POST" action="/event/updateCategory/{{$event->id}}" enctype="multipart/form-data">
                        @csrf

                         <div class="form-group row">
                            <label for="new_category" class="col-md-4 col-form-label text-md-right">{{ __('New category name') }}</label>
                            <div class="col-md-6">
                                <input id="new_category" type="text" class="form-control @error('new_category') is-invalid @enderror" name="new_category" value="{{old('new_category')}}" required>

                                @error('new_category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                       <div class="form-group row">
                            <label for="first_category" class="col-md-4 col-form-label text-md-right">{{ __('First category') }}</label>
                            <div class="col-md-6">
                                <select name="first_category" class="form-control @error('first_category') is-invalid @enderror" value="{{old('first_category')}}" required>
                                    <option value="">{{__("Select a category")}}</option>
                                    @foreach ($categories as $category)

                                    <option value="{{$category}}">{{$category}}</option>

                                    @endforeach

                                </select>

                                @error('first_category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Invalid")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="second_category" class="col-md-4 col-form-label text-md-right">{{ __('Second category')}} </label>
                            <div class="col-md-6">
                                <select name="second_category" class="form-control @error('second_category') is-invalid @enderror" value="{{old('second_category')}}" required>
                                    <option value="">{{__("Select a category")}}</option>
                                    @foreach ($categories as $category)

                                    <option value="{{$category}}">{{$category}}</option>

                                    @endforeach

                                </select>

                                @error('second_category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Invalid")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __("Update") }}
                                </button>
                            </div>
                        </div>

                        
                    </form>
                </div> <!-- end of  card-->
                
            </div>
        </div>
    </div>
</div>

@endsection
