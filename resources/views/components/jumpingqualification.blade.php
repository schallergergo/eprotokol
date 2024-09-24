      <div class="card">
        <div class="card-header">

          {{$name}} {{ __('Qualification') }} {{count($qualifications)}}
          <a href="/jumpingqualification/excel">Excel</a>

        </div>
        <div class="card-body">
          <div class="row mb-2 border">
            <div class="col-md-4 p-1 border d-none d-md-block ">
              <span class="align-middle font-weight-bold">{{__("Rider")}}</span>
            </div>
            <div class="col-md-4 p-1 border d-none d-md-block">
              <span class="align-middle font-weight-bold">{{__("Horse")}}</span>
            </div>
            <div class="col-md-4 p-1 border d-none d-md-block">
              <span class="align-middle font-weight-bold">{{__("Result")}}</span>
            </div>
          </div>
          <!-- end of the row--> 
          @foreach ($qualifications as $qualification) <div class="row mb-2 border">
            <div class="col-md-4 p-1 border">
              <span class="align-middle">

                {{$qualification["start"]->rider_name}} ( {{$qualification["start"]->rider_id}} )
                {{$qualification["start"]->horse_name}} ( {{$qualification["start"]->horse_id}} )

              </span>
            </div>
            <div class="col-md-4 p-1 border">
              <span class="align-middle">{{$qualification["start"]->club}} </span>
            </div>
            <div class="col-md-4 p-1 border"> @json($qualification["rider_array"]) </div>
          </div>
          <!-- end of the row--> 
        @endforeach
        </div>
        <!-- end of the row-->
      </div> <!-- end of the card-->