$(window).load(function () {
    /*
     *  Scroll To Top
     */
    if ($('#scroll-to-top')[0] && $('#top-link-block')[0]) {
        $('#scroll-to-top').click(function () {
            $('html,body').animate({scrollTop: 0}, 'slow');
            return false;
        });

        if (($(window).height() + 100) < $(document).height()) {
            $('#top-link-block').removeClass('hidden').affix({
                // how far to scroll down before link "slides" into view
                offset: {top: 100}
            });
        }
    }
});