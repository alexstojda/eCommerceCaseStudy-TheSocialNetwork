//Some good ajax to deal with them likes
function getR(type, post_id, group) {
    var set = 1;
    if($('#' + type + post_id).hasClass('rep')) {
        set = 0;
    }
    $.ajax({
        url: 'http://devbana.tk/post/newResponse',
        type: 'POST',
        data: {
            'post_id' : post_id,
            'rep'     : type,
            'set'     : set,
            'is_group': group
        },
        success: function (result) { //TODO: not hardcode... json_encode
            $("[id*=" + post_id + "]").removeClass('rep');
            if(set == 1)
                $('#' + type + post_id).addClass('rep');
            $('#' + type + post_id).html(' ' + result);
            if (type === 'like') {
                type = 'dislike';
            } else {
                type = 'like';}
            $.ajax({
                url: 'http://devbana.tk/post/getResponse',
                type: 'POST',
                data: {
                    'post_id': post_id,
                    'rep'    : type
                },
                success: function (result) {
                    $('#' + type + post_id).html(' '+result);
                }
            });
        }
    });
}