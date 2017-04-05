(function postOffline() {
    if (typeof jQuery == 'undefined') {
        // jQuery is not loaded
        setTimeout(postOffline, 100);
        return;
    }
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

        setInterval(Offline.check, 5000);

        Offline.on("up", function () {
            saveLocalPosts(false);
        });

        var postClickHandler = function (e) {
            e.preventDefault();

            function up() {
                Offline.off("confirmed-up", up);
                Offline.off("confirmed-down", down);
                console.log("is up");
                $("#postbutton").off("click", postClickHandler);
                saveLocalPosts(true);
            }

            function down() {
                Offline.off("confirmed-up", up);
                Offline.off("confirmed-down", down);
                console.log("is down");
                var $postbutton = $("#postbutton");
                $postbutton.notify("No connection.", "error");

                var form = $("#new-post-form");
                var $post = $("#newpost");
                var post = $post.val();
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
                $postbutton.notify("Saved post data locally.", "info");
                $post.val("");
            }

            Offline.on("confirmed-up", up);
            Offline.on("confirmed-down", down);
            Offline.check();
        };
        $("#postbutton").click(postClickHandler);

        function saveLocalPosts(submit) {
            var retrievedString = localStorage.getItem('localPosts');

            var retrievedObject;
            var total = 0;
            var saved = 0;

            function onAjaxReady(f) {
                console.log("checking if ready", total, saved);
                if (total === saved) {
                    console.log("is ready");
                    f();
                } else {
                    setTimeout(function () {
                        onAjaxReady(f);
                    }, 100);
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
                        if (post["publicPost"]) {
                            $.post("/home/create_new_post/" + key, {
                                'newpost': post["post"],
                                'child': post["childId"],
                                'publicpost': post["publicPost"]
                            }, function (data) {
                                // console.log(data);
                                saved++;
                            })
                        } else {
                            $.post("/home/create_new_post/" + key, {
                                'newpost': post["post"],
                                'child': post["childId"]
                            }, function (data) {
                                // console.log(data);
                                saved++;
                            })
                        }

                    }
                }
                console.log(retrievedObject);

            }
            if (submit) {
                onAjaxReady(function () {
                    localStorage.removeItem('localPosts');
                    console.log("cleared localPosts");
                    if (saved > 0)
                        $("#newpost").notify("Synced " + saved + " posts.", "success");
                    $("#postbutton").click();
                });
            } else {
                onAjaxReady(function () {
                    localStorage.removeItem('localPosts');
                    console.log("cleared localPosts");
                    if (saved > 0)
                        $("#newpost").notify("Synced " + saved + " posts.", "success");
                })
            }
        }
    });
})();
