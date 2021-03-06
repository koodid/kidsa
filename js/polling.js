(function initPolling() {
    if (typeof jQuery == 'undefined' || typeof $().modal != 'function') {
        // jQuery is not loaded
        setTimeout(initPolling, 100);
        return;
    }
    $(document).ready(function () {
        var lastTimeResponse = 0;

        function pollingFunction(container) {

            return $.ajax({
                type: "POST",
                url: "../Welcome/postsCount",
                cache: false,
                dataType: "json",
                success: function (data) {
                    if (data != null) {
                        //console.log("PollingPosts " + data);
                        $('#postPolling').html(data);
                        if (lastTimeResponse > 0 && lastTimeResponse !== parseInt(data)) {
                            var range = parseInt(data) - lastTimeResponse;
                            $.ajax({
                                method: "GET",
                                url: "../Welcome/getNewPosts/" + range,
                                success: function (result) {
                                    $("#newPostsTitel").removeClass('hidden');
                                    $('#newPosts').html(result);
                                }
                            })
                        }
                        // store the most recent value
                        lastTimeResponse = parseInt(data);
                    }
                },
                complete: function () {
                    setTimeout(function () {
                        pollingFunction(container)
                    }, 10000);
                }
            });
        }

        pollingFunction();
    });
})();
