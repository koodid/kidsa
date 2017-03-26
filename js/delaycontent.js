(function delayContent() {
    if (typeof jQuery == 'undefined') {
        // jQuery is not loaded
        setTimeout(delayContent, 100);
        return;
    }
    $(document).ready(function () {
        $('p[data-img-name]').prepend(function (index) {
            var name = $(this).attr('data-img-name')
            return '<img class="img-responsive hidden-xs" src="/images/' + name + '">'
        })
    });
})();
