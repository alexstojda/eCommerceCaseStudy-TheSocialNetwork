$(document).ready(function () {
    function respond(type, post_id) {
        $.ajax({
            url: 'http://devbana.tk/post/getResponse',
            type: 'POST',
            data: {
                'post_id': post_id,
                'rep': type
            }, // An object with the key 'submit' and value 'true;
            success: function (result) {
                alert('result');
                $("[id*=post_id]").removeClass('rep');
                $('#' + type + post_id).addClass('rep').text(result);
            }
        });
    }
});