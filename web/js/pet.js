$(function() {
    $('#food, #bath').tooltip();

    $('#pet').mouseover(function() {
        $('#pet').popover('show').addClass('shake shake-slow');
    }).mouseout(function() {
            $('#pet').popover('hide').removeClass('shake shake-slow shake-hard');
        });
});
