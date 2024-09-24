
                <div class="card-header">

                    {{ __('Edit event') }}



                        <a href="/event/export/{{$event->id}}" target="_blank">{{__("Export results")}} </a>

                        <a href="/event/exportByKondor/{{$event->id}}" target="_blank">/ {{__("by Kondor")}}</a>



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

                            <label for="start_fee" class="col-md-4 col-form-label text-md-right">{{ __('Start fee') }}</label>

                            <div class="col-md-6">

                                <input id="start_fee" type="number" class="form-control @error('start_fee') is-invalid @enderror" name="start_fee"  value="{{$event->start_fee}}" disabled>



                                @error('start_fee')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{__("Something is wrong... I know very helpful.")}}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>









                         <div class="form-group row">

                            <label for="sponsor" class="col-md-4 col-form-label text-md-right"><a href="/event/resetSponsor/{{$event->id}}">{{ __('Sponsor') }}</a></label>



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

                    