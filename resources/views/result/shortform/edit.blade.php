@extends('layouts.app')
@section ('title',$start->event->program->name." - ".$start->rider_name." - ".$start->horse_name)




@section('content')

<div class="container">
         @if (session('fail'))
    <div class="alert alert-danger">
        {{ session('fail') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{$start->rider_name}} - {{$start->horse_name}} - {{$start->club}}
                    
                </div>
                
                <div class="card-body">
                <?php $i=0; ?>
                <form action="/result/update/{{$result->id}}" method="post">
                    @csrf
                    @method('PATCH')
                    
                <div class="row">
                    <div class="col-md-7 p-2 border"><h5>{{ $start->event->program['name'] }}</h5></div>
                 <div class="col-md-1 p-2 border"><h5>{{__("Coefficient")}}</h5></div>
                <div class="col-md-4 p-2 border"><h5>{{__("Remark")}}</h5></div>
                   
                </div>

                    @foreach ($blocks as $block)
                    <div class="row">
                    
                        <div class="col-md-1 p-2 border">
                            <p>{{ $block['ordinal'] }}</p>
                        </div>
                        @if ($block["programpart"]===1)
                        <div class="col-md-2 p-2 border">
                            <pre>{{ $block['letters'] }}</pre>
                        </div>
                        @endif
                        @if ($block["programpart"]==1)
                        <div class="col-md-4 p-2 border">
                            <pre>{{ $block['criteria'] }}</pre>
                        </div>
                        @else
                        <div class="col-md-6 p-2 border">
                            <pre>{{ $block['criteria'] }}</pre>
                        </div>
                        @endif
                        
                        @if ($block['coefficient']===2)
                        <div class="col-md-1 p-2 border">
                            <center>
                                <p>2</p>
                            </center>
                        </div>

                        @else
                        <div class="col-md-1 p-2 border">
                            <center>
                                <p>1</p>
                            </center>
                        </div>
                        @endif
                        <input type="number" hidden="hidden" value="0" name="mark[]">
                    <div class="col-md-4 p-2 border">
        <textarea class="form-control" name="remark[]">{{$assessment[$i]->remark}}</textarea>
                    </div>
                            </div> <!--end of the row-->
                            <?php $i++; ?>
                           @endforeach

                    <div class="row">
                    
                        <div class="col-md-12 p-2 border">
                            <p>{{__("Leave arena at A in free walk")}}</p>
                        </div>
                    </div>
                     <div class="row">
                    
                        <div class="col-md-12 p-2 border">
                            <strong><p>{{__("Collective marks")}}</p></strong>
                        </div>
                    </div>
<!-- Összbenyomás-->
                    @foreach ($collectivemarks as $block)
                    <div class="row">
                    
                        <div class="col-md-1 p-2 border">
                            <p>{{ $block['ordinal'] }}</p>
                        </div>
                        @if ($block["programresz"]===1)
                        <div class="col-md-2 p-2 border">
                            <pre>{{ $block['letters'] }}</pre>
                        </div>
                        @endif
                        @if ($block["programpart"]==1)
                        <div class="col-md-4 p-2 border">
                            <pre>{{ $block['criteria'] }}</pre>
                        </div>
                        @else
                        <div class="col-md-6 p-2 border">
                            <pre>{{ $block['criteria'] }}</pre>
                        </div>
                        @endif
                        
                        @if ($block['coefficient']===2)
                        <div class="col-md-1 p-2 border">
                            <center>
                                <p>2</p>
                            </center>
                        </div>

                        @else
                        <div class="col-md-1 p-2 border">
                            <center>
                                <p>1</p>
                            </center>
                        </div>
                        @endif
                       <input type="number" hidden="hidden" value="0" name="mark[]">
                    <div class="col-md-4 p-2 border">
                        <textarea class="form-control" name="remark[]">{{$assessment[$i]->remark}}</textarea>
                    </div>
                            </div> <!--end of the row-->
                            <?php $i++; ?>
                           @endforeach
                    <div class="row">
                         <div class="col-md-3 p-2 border">
                            <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="1" id="eliminated" name="eliminated" @if ($result->eliminated==1) checked @endif>
                      <label class="form-check-label" for="eliminated">
                        {{__("The rider has been eliminated")}}
                      </label>
                        </div>
                        </div>
                         <div class="col-md-3 p-2 border">
                            <select class="custom-select" aria-label="__('Number of errors')" id="error" name="error">

                              <option value="0" @if ($result->error==0)selected @endif>{{__("No error")}}</option>
                              <option value="0.05" @if ($result->error==2)selected @endif>{{__("One error")}}</option>
                              <option value="0.1" @if ($result->error==6)selected @endif>{{__("Two errors")}}</option>
                              <option value="-1" @if ($result->error==-1)selected @endif>{{__("Three errors! Eliminated!")}}</option>
                            </select>
                    </div>
                     <div class="col-md-3 p-2 border form-horizontal">
                                <input id="given_mark" type="number" class="form-control @error('given_mark') is-invalid @enderror" min="0" max="10" step="0.01" 
                                name="given_mark" value="$result->mark" placeholder="{{__('Given mark')}}" required>

                                @error('given_mark')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{__("Licence number is invalid")}}</strong>
                                    </span>
                                @enderror

                        </div>
                    <div class="col-md-3 p-2 border">
                    <input type="submit" class="btn btn-primary btn-block" value="{{__('Send')}}" name="send">
                    </div>
                   </div>
                 </form>

                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('pagespecificscripts')
@if ($result->completed==0)
    <script src="{{ asset('js/resultUpdateAjax.js') }}"></script>
@endif
@endsection

               

               