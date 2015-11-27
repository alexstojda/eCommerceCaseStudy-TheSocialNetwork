function getR(type, post_id) {
    var set = 1;
    if($("[id*="+post_id+"]").hasClass('rep')) {
        set = 0;
    }
    $.ajax({
        url: 'http://devbana.tk/post/newResponse',
        type: 'POST',
        data: {
            'post_id': post_id,
            'rep'    : type,
            'set'    : set
        }, // An object with the key 'submit' and value 'true;
        success: function (result) {
            $("[id*="+post_id+"]").removeClass('rep').text('0');
            $('#' + type + post_id).addClass('rep').html(result);
        }
    });
}