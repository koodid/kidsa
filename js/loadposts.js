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
        if (typeof(XSLTProcessor) === 'undefined') {
            // Workaround for IE
            $("#load_post_button").hide();
            offset = 50;
            allPosts();
        } else {
            var parsedXML = jQuery.parseXML(data);
            var xsltProcessor = new XSLTProcessor;
            xsltProcessor.importStylesheet(xlst);
            $(selector)[fn](xsltProcessor.transformToFragment(parsedXML, document));
            $(selector).html($(selector).html().replace(/&lt;br&gt;/g, "<br>"))
        }
    }

    function loadMore() {
        var params = offset + "/" + limit;
        $.ajax({
            method: "GET",
            url: location.protocol + '//' + location.hostname + "/css/post.xsl"
        }).done(function (xlst) {
            $.ajax({
                method: "GET",
                url: location.protocol + '//' + location.hostname + "/ajax/load_some_posts/" + params,
                error: function (xhr, status, error) {
                    // $("#load_post_button").hide();
                    console.log("error in loadmore")
                }
            }).done(function (result) {
                addFromXML(result, xlst, '#load-more', 'append');
                offset += limit;
                window.onscroll = yHandler;
            });
        });
    }

    function allPosts() {
        return $.ajax({
            type: "GET",
            url: "../Welcome/showAllPublicPosts",
            success: function (data) {
                if (data != null) {
                    $('#load-all').html(data);
                }
            }
        });
    }

    window.onscroll = yHandler;

    $(document).ready(function () {
        loadMore();
    });

    $("#load_post_button").click(function (e) {
        loadMore();
    })
})();
