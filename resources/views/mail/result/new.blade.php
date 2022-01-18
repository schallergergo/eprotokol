@component('mail::message')
# {{__("New result is available")}}<br><br>

**{{__("Rider")}}**: {{$start->rider_name}}<br>
**{{__("Horse")}}**: {{$start->horse_name}}<br>
**{{__("Event")}}**: {{$start->event->event_name}}<br>
**{{__("Venue")}}**: {{$start->event->competition->venue}}<br>
**{{__("Date")}}**: {{$start->event->competition->date}}<br>

@foreach ($start->result->sortBy('position') as $result)
@component('mail::button', ['url' => "http://szakdolgozat.schallergergo.hu/result/show/".$result->id])
{{$result->position}} {{__("judge")}}

@endcomponent
@endforeach
{{__("Regards")}},<br>
{{ config('app.name') }}
@endcomponent