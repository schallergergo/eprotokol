







              
                 <div class="card-header">

                    {{ __('Edit category') }}

                    <a href="/event/resetCategory/{{$event->id}}">{{__("Reset category")}}</a>

                    @if ($event->isLonge())
                    <a href="/event/secondStart/{{$event->id}}">{{__("2nd start")}}</a>
                    @endif

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

                