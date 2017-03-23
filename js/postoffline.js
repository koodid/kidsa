$(document).ready(function () {
    Offline.options = {
        checks: {
            xhr: {
                url: function () {
                    return "/favicon.ico?_=" + (new Date).getTime()
                }, timeout: 1e3, type: "HEAD"
            }, image: {
                url: function () {
                    return "/favicon.ico?_=" + (new Date).getTime()
                }
            }, active: "xhr"
        }, checkOnLoad: !1, interceptRequests: !0, reconnect: !0, deDupBody: !1
    };

    var postClickHandler = function (e) {
        e.preventDefault();

        function up() {
            Offline.off("confirmed-up", up);
            Offline.off("confirmed-down", down);
            console.log("is up");
            $("#postbutton").off("click", postClickHandler);
            saveLocalPosts();
        }

        function down() {
            Offline.off("confirmed-up", up);
            Offline.off("confirmed-down", down);
            console.log("is down");
            var form = $("#new-post-form");
            var post = $("#newpost").val();
            var childId = $("#childpicker").val();
            var publicPost = $("#publicpost").is(":checked") === true;
            if (!post) {
                console.log("no post, ignored");
                return;
            }

            var retrievedString = localStorage.getItem('localPosts');

            var retrievedObject;
            if (retrievedString) {
                retrievedObject = JSON.parse(retrievedString);
            } else {
                retrievedObject = {}
            }

            retrievedObject[Math.floor($.now() / 1000)] = {
                "post": post,
                "childId": childId,
                "publicPost": publicPost
            };

            localStorage.setItem('localPosts', JSON.stringify(retrievedObject));
            console.log("Saved post data to localstorage");
        }

        Offline.on("confirmed-up", up);
        Offline.on("confirmed-down", down);
        Offline.check();
    };
    $("#postbutton").click(postClickHandler);

    function saveLocalPosts() {
        var retrievedString = localStorage.getItem('localPosts');

        var retrievedObject;
        var total = 0;
        var saved = 0;

        function submitIfAjaxReady() {
            console.log("checking if ready", total, saved);
            if (total == saved) {
                $("#postbutton").click();
            } else {
                setTimeout(submitIfAjaxReady, 100);
            }
        }

        if (retrievedString) {

            retrievedObject = JSON.parse(retrievedString);

            for (var key in retrievedObject) {
                if (retrievedObject.hasOwnProperty(key)) {
                    total++;
                    var post = retrievedObject[key];
                    console.log("key", key);
                    console.log(post);
                    // TODO postbutton - until there is display of that there is no easy way to test
                    $.post("/home/create_new_post/" + key, {
                        'newpost': post["post"],
                        'child': post["childId"],
                        'postbutton': ""
                    }, function (data) {
                        // console.log(data);
                        saved++;
                    })
                }
            }
            console.log(retrievedObject);
            localStorage.removeItem('localPosts');
            console.log("cleared localPosts");
        }
        submitIfAjaxReady();
    }
});