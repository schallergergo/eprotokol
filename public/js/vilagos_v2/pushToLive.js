$('#pushLiveBtn').on('click', function () {

    let isLive = $('#liveToggle').is(':checked');

    if (isLive) {
        return; // safety check
    }

    let segments = [];
    pushToLive();
    alert('pushed');
});



function pushToLive() {

    var token = $('meta[name="csrf-token"]').attr('content');
    console.log(App.state);
    const payload = {
        competitionId: App.state.competitionId,
        eventId: App.state.eventId,
        eventName: App.state.eventName,
        completedStartData: App.state.completedStartData,
        pendingStartData: App.state.pendingStartData,
        display: App.state.display,
        mode: App.state.mode,
        title: App.state.title,
        message: App.state.message,
        automaticEvents:getAutomaticEvents()
    };
    console.log(payload);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': token
        },
        url: '/display/pushToLive/' + App.state.competitionId,
        method: 'POST',
        data: payload, 

        success: function (res) {
            console.log('Pushed to live:', res);
        },

        error: function (err) {
            console.error('Push failed:', err);
        }
    });
}


$('#pushTestBtn').on('click', function () {

    let isLive = $('#liveToggle').is(':checked');

    if (isLive) {
        return; // safety check
    }

    let segments = [];
/*
    $('.display').each(function () {
        let segment = {
            event_id: $(this).find('.event-select').val(),
            start_id: $(this).find('.start-select').val(),
            message: $(this).find('.custom-message').val()
        };

        segments.push(segment);
    });

    $.post('/display/push-live', {
        _token: '{{ csrf_token() }}',
        competition_id: $('#competition_id').val(),
        segments: segments
    }, function () {
        alert('Pushed to live display!');
    });
    */
    App.render();
});

function getAutomaticEvents() {
    return $('input[name="events"]:checked')
        .map(function () {
            return $(this).val();
        })
        .get();
}