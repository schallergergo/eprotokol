







              
                 <div class="card-header">

                    {{ __('Swap start') }}

                  

                </div>

                <div class="card-body">

                    <form method="POST" action="/event/swapStarts/{{$event->id}}" enctype="multipart/form-data">

                        @csrf



                        


                       <div class="form-group row">

                            <label for="start1" class="col-md-4 col-form-label text-md-right">{{ __('Start 1') }}</label>

                            <div class="col-md-6">

                                <select name="start1" class="form-control @error('start1') is-invalid @enderror" value="{{old('start1')}}" required>

                                    <option value="">{{__("Select a start")}}</option>

                                    @foreach ($event->start as $start)



                                    <option value="{{$start->id}}">{{$start->rider_name}} - {{$start->horse_name}}</option>



                                    @endforeach



                                </select>



                                @error('start1')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{__("Invalid")}}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>


                       <div class="form-group row">

                            <label for="start2" class="col-md-4 col-form-label text-md-right">{{ __('Start 1') }}</label>

                            <div class="col-md-6">

                                <select name="start2" class="form-control @error('start2') is-invalid @enderror" value="{{old('start2')}}" required>

                                    <option value="">{{__("Select a start")}}</option>

                                    @foreach ($event->start as $start)



                                    <option value="{{$start->id}}">{{$start->rider_name}} - {{$start->horse_name}}</option>



                                    @endforeach



                                </select>



                                @error('start2')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{__("Invalid")}}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>


                         



                        <div class="form-group row mb-0">

                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">

                                    {{ __("Swap") }}

                                </button>

                            </div>

                        </div>



                        

                    </form>

                </div> <!-- end of  card-->

                