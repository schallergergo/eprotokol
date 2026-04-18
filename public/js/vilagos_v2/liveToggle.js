$('#liveToggle').on('change', function () {
    let isLive = $(this).is(':checked');
    

    if (isLive) {
        startLivePolling();
        $('#modeLabel')
            .text('LIVE MODE')
            .css('color', '#dc3545');
    } else {
        stopLivePolling();
        $('#modeLabel')
            .text('TEST MODE')
            .css('color', '#28a745');
    }
});

$('#liveToggle').on('change', function () {

    let isLive = $(this).is(':checked');
    App.state.mode = isLive ? 'live' :'test';
    $('#pushLiveBtn').prop('disabled', isLive);
     $('#pushTestBtn').prop('disabled', isLive);
     
});

function startLivePolling() {

    if (App.pollingInterval) return;

    console.log('LIVE polling started');

    App.pollingInterval = setInterval(function () {

        if (App.state.mode !== 'live') return;

        $.get('/display/getStatus/' + App.state.competitionId, function (res) {

            if (!res || !res.length) return;

            const data = res[0];
            console.log('data')
            console.log(data);
            // 🔥 parse JSON fields
            const completed = data.completed_data ? JSON.parse(data.completed_data) : null;
            const pending = data.pending_data ? JSON.parse(data.pending_data) : null;
            const automaticEvents = data.completed_data ? JSON.parse(data.automatic_events) : null;
            const automaticArray = data.pending_data ? JSON.parse(data.automatic_array) : null;

            // ✅ update state
            App.setState({
                eventId: data['event_id'],
                eventName: data['event_name'],
                display: data['display'],
                title: data['title'],
                message: data['message'],
                completedStartData: completed,
                pendingStartData: pending,
                automaticEvents:automaticEvents,
                automaticArray:automaticArray
            });
            console.log('set?');
            console.log(App.state);
            App.render();

        });

    }, 3000); // 15 seconds
}

function stopLivePolling() {

    if (App.pollingInterval) {
        clearInterval(App.pollingInterval);
        App.pollingInterval = null;
        console.log('LIVE polling stopped');
    }
}