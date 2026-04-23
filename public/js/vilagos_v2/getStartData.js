
$(document).on('change', '.start-select-completed', function () {

    let container = $(this).closest('.display');
    let startId = $(this).val();
    console.log("hek");

     $.ajax({
            url: '/ajax/getStartResults/' + startId, //
            type: 'GET',
            dataType: 'json',

            success: function (data) {
                console.log(data);
                App.state.completedStartData = data;


                console.log('STATE UPDATED:', App.state);
            },

            error: function (xhr) {
                console.error('Error loading starts:', xhr.responseText);
            }
        });





});


$(document).on('change', '.start-select-pending', function () {

    let container = $(this).closest('.display');
    let startId = $(this).val();


     $.ajax({
            url: '/ajax/getStartResults/' + startId,
            type: 'GET',
            dataType: 'json',

            success: function (data) {
                App.pendingStartData = data;


                console.log('STATE UPDATED:', App.state);
            },

            error: function (xhr) {
                console.error('Error loading starts:', xhr.responseText);
            }
        });





});


   