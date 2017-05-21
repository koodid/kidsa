(function initLikes() {
    if (typeof jQuery == 'undefined' || typeof $().modal != 'function') {
        // jQuery is not loaded
        setTimeout(initLikes, 100);
        return;
    }
    window.addLike = function (id) {
        var before = $(".post-" + id + " > .like-amount").text();
        $.get("/ajax/set_like/" + id, function (data) {
            $(".post-" + id + " > .like-amount").text(data);
            if (data > before) {
                $(".post-" + id + " > .glyphicon-star").addClass("liked");
            }
        }).fail(function (data) {
            if (data.status === 401) {
                $(".post-" + id + " > .like-amount").notify("Log in to add like", "error");
            } else {
                $(".post-" + id + " > .like-amount").notify("Error adding like", "error");
                console.log(data);
            }
        });
    };
})();
