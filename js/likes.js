(function initLikes() {
    if (typeof jQuery == 'undefined' || typeof $().modal != 'function') {
        // jQuery is not loaded
        setTimeout(initLikes, 100);
        return;
    }
    window.addLike = function (id) {
        $.get("/ajax/set_like/" + id, function (data) {
            $(".post-" + id + " > .like-amount").text(data);
        });
    };
})();
