$('.mode-select').on('change', function () {
    const display = $('.mode-select').val();
      App.state.display = display;

    // Example: push to display (adapt to your existing logic)
    // pushToLive({ title, message });
    console.log(App.state)
});


$('#custom_title').on('change', function () {
    const title = $('#custom_title').val();
      App.state.title = title;

    // Example: push to display (adapt to your existing logic)
    // pushToLive({ title, message });
    console.log(App.state)
});

$('#custom_message').on('change', function () {
    const message = $('#custom_message').val();
      App.state.message =message;
      console.log(App.state)

    // Example: push to display (adapt to your existing logic)
    // pushToLive({ title, message });
});