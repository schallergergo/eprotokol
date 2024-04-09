


<p>
	
	<a href="/transaction/index/{{$competition->id}}">{{__("Transactions")}}</a>
</p>


<p>
	
	<a href="/finance/didnotpay/competition/{{$competition->id}}">{{__("Did not pay")}}</a>
</p>

<p>
	
	<a href="/boxfee/index/{{$competition->id}}">{{__("Box fees")}}</a>
</p>
@foreach ($clubs as $club)

<p>
	
	<a href="/finance/filter/competition/{{$competition->id}}/filter/{{$club->club}}">{{$club->club}}</a>
</p>



@endforeach