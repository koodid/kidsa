$(document).ready(function () {

    $("#postbutton").click(function (e) {
        e.preventDefault();

        var form = $("#new-post-form");
        $.ajax({
            method: "POST",
            url: "/home/create_new_post",
            type: 'POST',
            data: form.serialize(),

            error: function (response) {
                console.log("error", response);
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
                console.log("Saved post data to localstorage");
                return response.status == 0;
            },
            success: function () {
                console.log("success");
                saveLocalPosts();
                console.log("saved local");
                location.reload(true);
                return true;
            }
        });
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
                        // console.log(data);
                    })
                }
            }
            console.log(retrievedObject);
            localStorage.removeItem('localPosts');
            console.log("cleared localPosts");
            // TODO clear posts from localstorage
        }
    }
})
;