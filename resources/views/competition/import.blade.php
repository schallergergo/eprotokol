@extends('layouts.app')
@section('title',__("Import starts competition"))

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Import starts') }}
                
                <span>


                   
                    <a href="/files/competition_import.xlsx">{{__("Import template")}}</a>
                    
                </span>



                
            </div>

                <div class="card-body">
                @if(!empty($competition->event))
                    <ul>
                        @foreach($competition->event as $event)
                            <li data-id="{{ $event->id }}">
                                ID: {{ $event->id }} — Name: {{ $event->event_name }}
                            </li>
                        @endforeach
                    </ul>
                    @else
                    <p>No events found.</p>
                    @endif
                  
                
                </div>

                  <div class="card-header">

                    {{ __('Add competitors') }}

                </div>

                <div class="card-body">

                    <form method="POST" action="/competition/saveImport/{{$competition->id}}" enctype="multipart/form-data">

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

                </div> <!-- end of  card-->
            </div>
        </div>
    </div>
</div>
@endsection
