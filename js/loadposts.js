(function initLoadPosts() {
    if (typeof jQuery == 'undefined' || typeof $().modal != 'function') {
        // jQuery is not loaded
        setTimeout(initLoadPosts, 100);
        return;
    }

    var offset = 0;
    var limit = 10;

    function yHandler() {
        var body = document.getElementById('body');
        var contentHeight = body.offsetHeight;
        var y = window.pageYOffset + window.innerHeight;
        if (y + 400 >= contentHeight) {
            window.onscroll = null;
            if (offset < 50) {
                loadMore();
            }
        }
    }

    function addFromXML(data, xlst, selector, fn) {
        var parsedXML = jQuery.parseXML(data);
        var xsltProcessor = new XSLTProcessor;
        xsltProcessor.importStylesheet(xlst);
        $(selector)[fn](xsltProcessor.transformToFragment(parsedXML, document));
    }

    function loadMore() {
        var params = offset + "/" + limit;
        $.ajax({
            method: "GET",
            url: location.protocol + '//' + location.hostname + "/css/post.xsl"
        }).done(function (xlst) {
            $.ajax({
                method: "GET",
                url: location.protocol + '//' + location.hostname + "/home/load_some_posts/" + params,
                error: function (xhr, status, error) {
                    // $("#load-button").hide();
                    console.log("error in loadmore")
                }
            }).done(function (result) {
                addFromXML(result, xlst, '#load-more', 'append');
                offset += limit;
                window.onscroll = yHandler;
            });
        });
    }

    window.onscroll = yHandler;

    $("#load_post_button").click(function (e) {
        loadMore();
    })
})();
