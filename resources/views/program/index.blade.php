@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Programs') }}
                     @can("create",App\Models\Program::class)
                    <a href="/program/create">{{__("Add new program")}}</a>
                    @endcan
                </div>

                <div class="card-body">
                    <form method="GET" action="" enctype="multipart/form-data">
                        

                       <div class="form-group row">
                            <label for="discipline" class="col-md-4 col-form-label text-md-right">{{ __("Discipline") }}</label>
                            <div class="col-md-6">
                                <select id="discipline"  class="form-control @error('program') is-invalid @enderror" name="discipline"  required>
                                <option value="" @if ($discipline=="") selected @endif> {{__("Select a discipline")}} </option>
                                <option value="poniklub" @if ($discipline=='poniklub') selected @endif> {{__("Pony Club")}} </option>
                                <option value="lovastusa" @if ($discipline=='lovastusa') selected @endif> {{__("Eventing")}} </option>
                                <option value="dijlovas" @if ($discipline=='dijlovas') selected @endif> {{__("Dressage")}} </option>
                            
                            </select required>

                                @error('discipline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Too long")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                  

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Select') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @isset($programs)
                    <div class="p-2">
                    <div class="row mb-2 border">
                        <div class="col-md-9 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Name")}}</span>
                        </div>
                        
                        <div class="col-md-3 p-1 border d-none d-md-block">
                            <span class="align-middle font-weight-bold">{{__("Options")}}</span>
                        </div>

                    </div><!-- end of the row-->
                    @foreach ($programs as $program)
                    <div class="row mb-2 border">
                        <div class="col-md-9 p-1 border">
                            <span class="align-middle">{{$program->name}}</span>
                        </div>


                        <div class="col-md-3 p-1 border">
                            <span class="align-middle"><a href="/program/show/{{$program->id}}" target="_blank">  {{__("View program")}}</a></span>
                             @can ("update",$program)
                            <span class="align-middle"><a href="/program/edit/{{$program->id}}" target="_blank">  {{__("Edit")}}</a></span>
                            @endcan
                        </div>

                    </div><!-- end of the row-->
                    
                    @endforeach
                </div>
                    @endisset
                    </div><!-- end of the row-->
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
