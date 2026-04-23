$(document).on('change', '.event-select', function () {

    let container = $(this).closest('.display');
    let eventId = $(this).val();
    let eventName = $(this).find('option:selected').text();
    App.state.eventId = eventId;
    App.state.eventName = eventName;

    console.log(App.state);
    loadStarts(eventId, container);

});


$(document).on('click', '.refresh-starts', function () {

    let container = $(this).closest('.display');
    let eventId = container.find('.event-select').val();

    if (!eventId) {
        alert('Please select an event first');
        return;
    }

    loadStarts(eventId, container);

});

function loadStarts(eventId, container) {

    let pendingDropdown = container.find('.start-select-pending');
    let completedDropdown = container.find('.start-select-completed');

    pendingDropdown.html('<option value="">Pending Starts</option>');
    completedDropdown.html('<option value="">Completed Starts</option>');


    if (!eventId) return;

    $.ajax({
        url: '/ajax/getEventStarts/' + eventId,
        type: 'GET',
        dataType: 'json',

        success: function (data) {

            let pending = [];
            let completed = [];
            console.log('data');
            console.log(data);
            // 🔹 Split
            data.forEach(function (start) {
                if (start.completed) {
                    completed.push(start);
                } else {
                    pending.push(start);
                }
            });

            // 🔹 Sort completed by updated_at DESC
            completed.sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at));

            // 🔹 Sort pending by rank ASC
            pending.sort((a, b) => a.rank - b.rank);

            // 🔹 Populate dropdowns
            pending.forEach(function (start) {
                let text = start.rider_name + ' - ' + start.horse_name;

                pendingDropdown.append(
                    $('<option>', {
                        value: start.id,
                        text: text
                    })
                );
            });

            completed.forEach(function (start) {
                let text = start.rider_name + ' - ' + start.horse_name;

                completedDropdown.append(
                    $('<option>', {
                        value: start.id,
                        text: text
                    })
                );
            });

            // 🔹 Enable / disable
            pendingDropdown.prop('disabled', pending.length === 0);
            completedDropdown.prop('disabled', completed.length === 0);

            // 🔹 Set state
            App.state.eventId = eventId;
            App.state.pendingStartData = pending.length > 0 ? pending[0] : null;
            App.state.completedStartData = completed.length > 0 ? completed[0] : null;

       
            console.log('STATE UPDATED:', App.state);
        },

        error: function (xhr) {
            console.error('Error loading starts:', xhr.responseText);
        }
    });
}