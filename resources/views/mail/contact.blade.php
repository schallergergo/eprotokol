@component('mail::message')
# {{__("New message")}}<br><br>

**{{__("Name")}}**: {{$name}}<br>
**{{__("Email")}}**: {{$email}}<br>
**{{__("Message")}}**: {{$message}}<br>


{{__("Regards")}},<br>
{{ config('app.name') }}
@endcomponent