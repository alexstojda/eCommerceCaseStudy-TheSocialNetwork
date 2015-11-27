//source: http://bootsnipp.com/snippets/featured/bootstrap-lightbox
$(document).ready(function () {
    var lbox = $('#lightbox');

    //noinspection JSUnusedLocalSymbols
    $('[data-target="#lightbox"]').on('click', function (event) {
        var $img = $(this).find('img'),
            src = $img.attr('src'),
            alt = $img.attr('alt'),
            css = {
                'maxWidth': $(window).width() - 100,
                'maxHeight': $(window).height() - 100
            };
        lbox.find('.close').addClass('hidden');
        lbox.find('img').attr('src', src);
        lbox.find('img').attr('alt', alt);
        lbox.find('img').css(css);
    });

    //noinspection JSUnusedLocalSymbols
    lbox.on('shown.bs.modal', function (e) {
        var $img = lbox.find('img');

        lbox.find('.modal-dialog').css({'width': $img.width()});
        lbox.find('.close').removeClass('hidden');
    });
});