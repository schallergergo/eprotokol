
<h1>
	 {{$transaction->type}} : {{$transaction->amount}}
</h1>



@foreach ($transaction->start_fee as $startfee)

@php
$start = $startfee->start;
@endphp
<p>
	
	{{$start->rider_name}} {{$start->horse_name}} 

</p>
	
@endforeach