@extends('layouts.app') <!-- Assuming you have a layout file -->

@section('content')
<div class="container">

    <h2>Rearrange Start List of <a href="/competition/show/{{$competition->id}}">{{$competition->name}}</a></h2>
    <ul id="events" class="list-group">
    @foreach($events as $event)

    <li class="list-group-item d-flex align-items-center" data-id="{{ $event->id }}">
        <span class="drag-handle mr-2" style="cursor: grab;">&#x2630;</span> 
          {{ $event->event_name }}
    </li>
    @endforeach
</ul>
    <button id="saveOrder" class="btn btn-primary mt-3">Save Order</button>
</div>
@endsection

@section('pagespecificscripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
    $(function() {
    // Make the list sortable and set the handle for dragging
    $("#events").sortable({
        handle: ".drag-handle" // The handle class to drag items
    });

    // Save the new order
    $("#saveOrder").click(function() {
        let order = [];

        $("#events li").each(function() {
            order.push($(this).data("id"));
        });
        if ( order.length == 0 ) return;
        $.ajax({
            url: "{{ route('competition.saveOrder',[$competition]) }}",
            method: 'POST',
            data: {
                order: order,
                _token: "{{ csrf_token() }}" // CSRF token for security
            },
            success: function(response) {
                alert('Order saved successfully!');
            },
            error: function(xhr) {
                alert('Error saving order.');
            }
        });
    });
});

</script>
@endsection