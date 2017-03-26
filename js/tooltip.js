(function initTooltips() {
    if (typeof jQuery == 'undefined' || typeof $().modal != 'function') {
        // jQuery is not loaded
        setTimeout(initTooltips, 100);
        return;
    }
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
})();