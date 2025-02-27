@extends('layouts.app')



@section('content')





<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">





               

                    <form method="POST" action="/eventing/cross/update/{{$cross->id}}" enctype="multipart/form-data" name='form' onsubmit="return validateForm()">

                        @csrf

                        @method("PATCH")





                        <div class="card-header">{{$start->rider_name}} - {{$start->horse_name}} {{ __('Cross') }}</div>

                         <div class="card-body">

                        <div class="form-group row">

                            <label for="time" class="col-md-4 col-form-label text-md-right">{{ __('Time') }}</label>



                            <div class="col-md-6">

                                <input id="time" type="number" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ $cross->time }}" step="any"required>



                                @error('time')

                                    <span class="invalid-feedback" role="alert">

                                          <strong>{{__("Field is invalid")}}</strong>

                                    </span>

                                @enderror

                            </div> 

                        </div>





                        <div class="form-group row">

                            <label for="obstacle_fault" class="col-md-4 col-form-label text-md-right">{{ __('Obstacle fault')}}</label>



                            <div class="col-md-6">

                                <input id="obstacle_fault" type="number" class="form-control @error('obstacle_fault') is-invalid @enderror" name="obstacle_fault" value="{{ $cross->obstacle_fault }}" step="any" required>



                                @error('obstacle_fault')

                                    <span class="invalid-feedback" role="alert">

                                          <strong>{{__("Field is invalid")}}</strong>

                                    </span>

                                @enderror

                            </div> 

                        </div>



                        <div class="form-group row">

                            <label for="time_fault" class="col-md-4 col-form-label text-md-right">{{ __('Time fault') }}</label>



                            <div class="col-md-6">

                                <input id="time_fault" type="number" class="form-control @error('time_fault') is-invalid @enderror" name="time_fault" value="{{ $cross->time_fault }}" step="any" required>



                                @error('time_fault')

                                    <span class="invalid-feedback" role="alert">

                                          <strong>{{__("Field is invalid")}}</strong>

                                    </span>

                                @enderror

                            </div> 

                        </div>





                        <div class="form-group row">

                            <label for="total_fault" class="col-md-4 col-form-label text-md-right">{{ __('Total fault') }}</label>



                            <div class="col-md-6">

                                <input id="total_fault" type="number" class="form-control @error('total_fault') is-invalid @enderror" name="total_fault" value="{{ $cross->total_fault}}" step="any"required>



                                @error('total_fault')

                                    <span class="invalid-feedback" role="alert">

                                          <strong>{{__("Field is invalid")}}</strong>

                                    </span>

                                @enderror

                            </div> 

                        </div>



                         <div class="form-group row">

                            <label for="comments" class="col-md-4 col-form-label text-md-right">{{ __('Comments') }}</label>



                            <div class="col-md-6">

                                <textarea id="comments" type="number" class="form-control @error('comments') is-invalid @enderror" name="comments" > {{$cross->comments}}</textarea>

                                @error('comments')

                                    <span class="invalid-feedback" role="alert">

                                          <strong>{{__("Field is invalid")}}</strong>

                                    </span>

                                @enderror

                            </div> 

                        </div>



                        

                         <div class="form-group row">

                            <label for="eliminated" class="col-md-4 col-form-label text-md-right">{{ __('Eliminated') }}</label>



                            <div class="col-md-6">

                                <select id="eliminated" type="number" class="form-control @error('eliminated') is-invalid @enderror" name="eliminated" required> 

                                    <option value=0>{{__("Not eliminated!")}}</option>

                                    <option value=1 @if ($cross->eliminated) selected @endif>{{__("Eliminated!")}}</option>

                                </select>

                                @error('eliminated')

                                    <span class="invalid-feedback" role="alert">

                                          <strong>{{__("Field is invalid")}}</strong>

                                    </span>

                                @enderror

                            </div> 

                        </div>





                        <div class="form-group row mb-0">

                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">

                                    {{ __('Send') }}

                                </button>

                            </div>

                        </div>

                        </div>

                    </form>

                       



    </div>

    </div>

</div>

@endsection

@section('pagespecificscripts')

<script type="text/javascript">

            function validateForm() {

          let obstacle_fault = parseFloat(document.forms["form"]["obstacle_fault"].value);

          let time_fault = parseFloat(document.forms["form"]["time_fault"].value);

          let total_fault = parseFloat(document.forms["form"]["total_fault"].value);



            console.log(obstacle_fault+time_fault,total_fault);

          if (obstacle_fault+time_fault != total_fault) {

            document.forms["form"]["total_fault"].value = "";

            return false;



          }

        }


    

 </script>

@endsection

