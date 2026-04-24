window.App = window.App || {};

App.state = {
    mode: 'test', // 'live' or 'test'

    competitionId: $('#competition_id').val(),
    eventId: null,
    eventName: null,

    completedStartData: null,
    pendingStartData: null,
    automaticEvents: null,
    automaticArray: null,

    display: 'default', // default | event | start | result | info
    title: '',
    message: ''
};

App.setState = function (data) {
    App.state.eventId = data.eventId;
    App.state.eventName = data.eventName;
    App.state.completedStartData = data.completedStartData;
    App.state.pendingStartData = data.pendingStartData;
    App.state.display = data.display;
    App.state.title = data.title;
    App.state.message = data.message;
    App.state.automaticEvents = data.automaticEvents;
    App.state.automaticArray = data.automaticArray;
}

function getResultString(start) {
        console.log('output'+start);
    if (!start || !start.result) return '';
console.log('output');
    let output = '';

    start.result.forEach(result => {
        output += `${result.position} : ${result.percent}% | `;
    });

    console.log(output);

    // remove last " | "
    return output.slice(0, -3);
}

App.render = function () {
    console.log('rendering');
    console.log(App.state);
    const panel = $('.display');
    const s = App.state;
    const now = new Date();
    let message_html = App.state.message ? '<h4> ' + App.state.message  + '</h4>' : '';
    const timeString = now.toLocaleTimeString('en-GB', {
        hour: '2-digit',
        minute: '2-digit'
    });

    switch (s.display) {

        case 'default':

       panel.find('.header_name').text( timeString || '');
        panel.find('.rider_name').html('<img src="/storage/logo/logo_med.png" class="img-fluid m-10" alt="Eprotokol logo">');
        panel.find('.horse_name').text( '');
        panel.find('.club_name').text('');
        panel.find('.result').text('');
            break;

        case 'event':
        
        panel.find('.header_name').text( timeString || '');
        panel.find('.rider_name').html(App.state.eventName || '');
        panel.find('.horse_name').text(App.state.title || '');
        panel.find('.club_name').html(message_html) ;
        panel.find('.result').text('');
            break;

         case 'info':
        panel.find('.header_name').text( timeString || '');
        panel.find('.rider_name').html('INFO');
        panel.find('.horse_name').text(App.state.title || '');
        panel.find('.club_name').html('<h4> ' + App.state.message || '' + '</h4>') ;
        panel.find('.result').text('');
            break;

         case 'rider':
            if(!App.state.pendingStartData && App.state.mode == 'test')
            {
                alert('No start selected');
                return;
            }
        panel.find('.header_name').text(App.state.eventName || '');
        panel.find('.rider_name').html(App.state.pendingStartData['rider_name'] || '');
        panel.find('.horse_name').text(App.state.pendingStartData['horse_name'] || '');
        panel.find('.club_name').html(App.state.pendingStartData['club'] || '') ;
        panel.find('.result').text('');
            break;

        case 'result':
            if(!App.state.completedStartData && App.state.mode == 'test')
            {
                alert('No start selected');
                return;
            }
        panel.find('.header_name').text(App.state.eventName || '');
        panel.find('.rider_name').text(App.state.completedStartData['rider_name'] || '');
        panel.find('.horse_name').text(App.state.completedStartData['horse_name'] || '');
        panel.find('.club_name').html(App.state.completedStartData['club'] || '') ;
        panel.find('.result').text(getResultString(App.state.completedStartData));
        break;
        default:
        panel.find('.header_name').text( timeString || '');
        panel.find('.rider_name').html('<img src="/storage/logo/logo_med.png" class="img-fluid m-10" alt="Eprotokol logo">');
        panel.find('.horse_name').text( '');
        panel.find('.club_name').text('');
        panel.find('.result').text();
            break;

            $('.rider_name').text('Waiting...');
            break;
    }
    console.log('rendered');
};