$(function() {
    $('#food, #bath').tooltip();

    $('#pet').mouseover(function(e) {
        if (!$('#pet').hasClass('sleep')) {
            $('#pet').popover('show').addClass('shake shake-slow');
        }
    }).mouseout(function(e) {
        $('#pet').popover('hide').removeClass('shake shake-slow shake-hard');
    });
});
