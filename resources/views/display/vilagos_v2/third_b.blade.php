<div class="display row">

    @foreach($competition->event as $event)
        <div class="col-md-6">
            <div class="form-check ml-2">
                <input class="form-check-input" type="checkbox"
                       value="{{$event->id}}"
                       id="event-{{$event->id}}"
                       name="events[]"
                       @if (in_array($event->id , $selected_events)) checked
                       @endif
                       >

                <label class="form-check-label" for="event-{{$event->id}}">
                    {{$event->event_name}}
                </label>
            </div>
        </div>
    @endforeach

</div>