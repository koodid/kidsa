$(document).ready(function () {
    var offline = false;

    $("#postbutton").click(function (e) {
        // TODO actual offline check
        if (offline) {
            e.preventDefault();
            var post = $("#newpost").val();
            var childId = $("#childpicker").val();
            var publicPost = $("#publicpost").is(":checked") === true;

            var retrievedString = localStorage.getItem('localPosts');

            var retrievedObject;
            if (retrievedString) {
                retrievedObject = JSON.parse(retrievedString);
            } else {
                retrievedObject = {}
            }

            retrievedObject[$.now()] = {
                "post": post,
                "childId": childId,
                "publicPost": publicPost
            };

            localStorage.setItem('localPosts', JSON.stringify(retrievedObject));
        }
    });

    Offline.on("up", function () {
        offline = false;
        console.log("now online");
        saveLocalPosts();
    });

    Offline.on("down", function () {
        offline = true;
        console.log("now offline")
    });

    function saveLocalPosts() {
        var retrievedString = localStorage.getItem('localPosts');

        var retrievedObject;
        if (retrievedString) {
            retrievedObject = JSON.parse(retrievedString);
            for (var key in retrievedObject) {
                if (retrievedObject.hasOwnProperty(key)) {
                    var post = retrievedObject[key];
                    console.log(post);
                    // TODO postbutton
                    $.post("/home/create_new_post", {
                        'newpost': post["post"],
                        'child': post["childId"],
                        'postbutton': ""
                    }, function (data) {
                        console.log(data);
                    })
                }
            }
            // TODO clear posts from localstorage
        }
    }
})
;