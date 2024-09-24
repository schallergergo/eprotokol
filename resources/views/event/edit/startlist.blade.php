
                <div class="card-header">

                    {{ __('Update startlist') }}




                </div>



                <div class="card-body">

                    <form method="POST" action="/event/updateStartlist/{{$event->id}}" enctype="multipart/form-data">

                        @csrf

                        @method('PATCH')



                        
                        <div class="form-group row">

                            <label for="has_startlist" class="col-md-4 col-form-label text-md-right">{{ __('Has startlist') }}</label>

                            <div class="col-md-6">

                                <select id="has_startlist" type="checkbox" class="form-control @error('has_startlist') is-invalid @enderror" name="has_startlist">
                                    <option value =1 @if($event->has_startlist) selected @endif>
                                        {{__("Yes")}}

                                    </option>

                                    <option value =0 @if(!$event->has_startlist) selected @endif>
                                        {{__("No")}}

                                    </option>
                                        

                                </select>   



                                @error('has_startlist')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{__("Something is wrong... I know very helpful.")}}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>


                          <div class="form-group row">

                            <label for="start_time" class="col-md-4 col-form-label text-md-right">{{ __('Event start time') }}</label>

                            <div class="col-md-6">

                                <input id="start_time" type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time"  value="{{$event_start_time}}">



                                @error('start_time')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{__("Something is wrong... I know very helpful.")}}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>



                        <div class="form-group row">

                            <label for="minutes_between_starts" class="col-md-4 col-form-label text-md-right">{{ __('Minutes between starts') }}</label>

                            <div class="col-md-6">

                                <input id="minutes_between_starts" type="number" class="form-control @error('minutes_between_starts') is-invalid @enderror" name="minutes_between_starts"  value="{{$minutes_between_starts}}">



                                @error('minutes_between_starts')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{__("Something is wrong... I know very helpful.")}}</strong>

                                    </span>

                                @enderror

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

                    