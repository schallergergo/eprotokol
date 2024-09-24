  <div class="card-header">

                    {{ __('Add competitors') }}

                    <a href="/files/result_template.xlsx">{{__("Import template")}}</a>

                </div>

                <div class="card-body">

                    <form method="POST" action="/start/import/{{$event->id}}" enctype="multipart/form-data">

                        @csrf

                       <div class="form-group row">

                            <label for="upload" class="col-md-4 col-form-label text-md-right">{{ __('Upload') }}</label>

                            <div class="col-md-6">

                                <input id="upload" type="file" class="form-control @error('upload') is-invalid @enderror" name="upload" required>



                                @error('upload')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{__("Invalid format")}}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>





                      



                        <div class="form-group row mb-0">

                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">

                                    {{ __("Upload") }}

                                </button>

                            </div>

                        </div>



                        

                    </form>

                </div> <!-- end of  card-->


