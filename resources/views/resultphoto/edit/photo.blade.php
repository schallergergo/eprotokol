                                <div class="card">

                <div class="card-header">{{ __('Edit result photo') }}
                

                
                </div> <!-- end of the header -->

                <div class="card-body">
                <form method="POST" action="/resultphoto/storePhoto/result/{{$result->id}}" enctype="multipart/form-data">
                        @csrf



                       <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Uploaded image') }}</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{$result->image}}" required>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Error")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

   
 


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>

                @foreach($photos as $photo)
                <div class="row align-items-center my-2">
                    <div class="col-md-4">
                    <span class="text-primary">{{$photo->created_at}}</span>
                    </div>
                   

                  <div class="col-md-4">
                    <a href="/storage/app/public/{{$photo->url}}" target="_blank" class="text-primary">View image</a>
                  </div>

                  <div class="col-md-4 text-end">
                    <button class="btn btn-danger">Delete</button>
                  </div>
                </div>

                @endforeach


                </div> <!-- end of body -->
            </div>