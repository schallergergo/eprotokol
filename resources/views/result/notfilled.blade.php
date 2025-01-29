
@extends('layouts.app')
@push('meta')
<meta name="robots" content="noindex">
@endpush
@section ('title',$start->event->program->name." - ".$start->rider_name." - ".$start->horse_name)
@section('content')

<div class="container">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{$start->rider_name}} - {{$start->horse_name}} - {{$start->club}}
                    @can('update',$result)
                        <span class="d-print-none">
                        <a href="/result/edit/{{$result->id}}">{{__("Edit result")}}</a>
                        <a class="d-flex float-right" href="/event/show/{{$result->start->event->id}}">{{__("Back")}}</a>
                        </span>
                    @endcan
                    @if ($result->completed>1)
                    @can('viewAny',[App\Models\Resultlog::class,$result])
                        <span class="d-print-none">
                        <a href="/resultlog/index/{{$result->id}}">{{__("View versions")}}</a>
                        </span>
                    @endcan
                    @endif
                </div>
                
                <div class="card-body">



    
                        <div class="row">
                        <div class="col-md-12 p-1 border text-left">
                        <h6>
                        @if ($result->eliminated==0)
                            {{__("Points")}}: <strong>{{number_format($result->mark, 1) }} {{__("points")}}  </strong>
                            - {{__("Percentage")}}: <strong>{{number_format($result->percent, 2) }} %       </strong>
                            - {{__("Collective")}}: <strong>{{number_format($result->collective, 2) }} {{__("points")}}      </strong>
                                @if ($result->error!=0 && $program->errortype==1)
                                - {{__("Deduction")}}: <strong>{{number_format($result->error, 0) }} {{__("points")}}</strong>
                                 @elseif ($result->error!=0 && $program->errortype==2)
                                - {{__("Deduction")}}!</strong>

                        @endif
                        @else
                        <strong>{{__("Eliminated!")}}</strong>
                        @endif

                                - {{__("Updated")}}: <strong>{{$result->updated_at}}</strong>
                                
                            </h6>
                        </div>
                    </div>

                    @foreach($photos as $photo)
                   
                    <div class="row pt-2">
                        <div class="col-md-12 p-1 border text-left">
                        
                        	<img src="/storage/app/public/{{$photo->url}}" width="100%">

                        </div>
                    </div>
                    @endforeach




                </div>
            </div>
        </div>
    </div>
</div>



@endsection