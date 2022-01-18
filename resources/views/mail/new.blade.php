@component('mail::message')
Hello,

Here is your result!

@component('mail::button', ['url' => {{url('')}}."/result/show/".{{$result->id}}])
Button Text
@endcomponent

{{__("Thanks")}},<br>
{{ config('app.name') }}
@endcomponent
