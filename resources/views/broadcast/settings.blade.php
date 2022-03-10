@extends('layouts.app')
@section('title','Kijelző beállítások')
@section('pagespecificscripts')

    <!-- flot charts css-->

@endsection
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Display settings') }}</div>

                <div class="card-body">
                    <form method="GET" action="/broadcast/{{$event->id}}/display">
                        





                       

                       
 



                        <div class="form-group row">
                            <label for="nameSize" class="col-md-4 col-form-label text-md-right">{{ __('Name size') }}</label>

                            <div class="col-md-6">
                                <select id="nameSize"  class="form-control @error('nameSize') is-invalid @enderror" name="nameSize"  required>
                            @for ($i=1;$i<=6;$i++)
                                <option value="display-{{$i}}"> display-{{$i}} </option>
                            @endfor
                            </select>

                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="pointSize" class="col-md-4 col-form-label text-md-right">{{ __('Point size') }}</label>

                            <div class="col-md-6">
                                <select id="pointSize"  class="form-control @error('nameSize') is-invalid @enderror" name="pointSize"  required>
                            @for ($i=6;$i>0;$i--)
                                <option value="display-{{$i}}"> display-{{$i}} </option>
                            @endfor
                            </select>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Start') }}
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
