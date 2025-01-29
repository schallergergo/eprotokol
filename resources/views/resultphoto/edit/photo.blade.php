                                <div class="card">

                <div class="card-header">{{ __('Image upload') }}
                

                
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
                                        <strong>{{__("Upload an image!")}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

   
 


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload') }}
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
                    <a class="btn btn-info" href="/storage/app/public/{{$photo->url}}" target="_blank">{{__("View image")}}</a>
                  </div>

                  <div class="col-md-4 text-end">
                    <a href="/resultphoto/{{$photo->id}}/delete"><button class="btn btn-danger">


                        @if ($photo->deleted) {{__("Restore")}}
                        @else {{__("Delete")}}
                        @endif

                    </button></a>
                  </div>
                </div>

                @endforeach


                </div> <!-- end of body -->
            </div>