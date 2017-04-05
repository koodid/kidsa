(function initPolling() {
    if (typeof jQuery == 'undefined' || typeof $().modal != 'function') {
        // jQuery is not loaded
        setTimeout(initPolling, 100);
        return;
    }
    $(document).ready(function () {
        var lastTimeResponse = "";

        function pollingFunction(container) {

            return $.ajax({
                type: "POST",
                url: "../Welcome/postsCount",
                cache: false,
                dataType: "json",
                success: function (data) {
                    if (data != null) {
                        console.log("PollingPosts " + data);
                        $('#postPolling').html(data);
                        if (lastTimeResponse.length > 0 && lastTimeResponse !== data) {
                            var range = data - lastTimeResponse;
                            $.ajax({
                                method: "GET",
                                url: "../Welcome/getNewPosts/" + range,
                                dataType: "json",
                                success: function (result) {
                                    $('#newPosts').html(result);
                                }
                            })
                        }
                        // store the most recent value
                        lastTimeResponse = data;
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
