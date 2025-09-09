                <div class="card">

                <div class="card-header">{{ __('Edit result') }}
                
                    <span class="float-right"><a href="/event/show/{{$result->start->event->id}}">{{__("Back")}}</a></span>
                
                </div> <!-- end of the header -->

                <div class="card-body">
                <form method="POST" action="/resultphoto/updateResult/result/{{$result->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')



                       <div class="form-group row">
                            <label for="mark" class="col-md-4 col-form-label text-md-right">{{ __('Given points') }}</label>
                            <div class="col-md-6">
                                <input id="mark" type="number" class="form-control @error('mark') is-invalid @enderror" name="mark" value="{{$result->mark}}" required>

                                @error('mark')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Error")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="percent" class="col-md-4 col-form-label text-md-right">{{ __('Percent') }}</label>
                            <div class="col-md-6">
                                <input id="percent" type="number" class="form-control @error('percent') is-invalid @enderror" name="percent" value="{{$result->percent}}" required>

                                @error('percent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Error")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="collective" class="col-md-4 col-form-label text-md-right">{{ __('Collective') }}</label>
                            <div class="col-md-6">
                                <input id="collective" type="number" class="form-control @error('collective') is-invalid @enderror" name="collective" value="{{$result->collective}}" required>

                                @error('collective')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Error")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>





                       
 


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>