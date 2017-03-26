(function initFormListeners() {
    if (typeof jQuery == 'undefined') {
        // jQuery is not loaded
        setTimeout(initFormListeners, 100);
        return;
    }
    $(document).ready(function () {
        $("#username").on("input", function () {
            console.log("#username changed: ", $(this).val());
            // possibly validate that username is not in use
        });

        $("#password").on("input", function () {
            if ($("#confirmpassword").val() !== $(this).val()) {
                $("#confirmpasswordHolder").addClass("has-error");
            } else {
                $("#confirmpasswordHolder").removeClass("has-error");
            }
        });

        $("#confirmpassword").on("input", function () {
            if ($("#password").val() !== $(this).val()) {
                $("#confirmpasswordHolder").addClass("has-error");
            } else {
                $("#confirmpasswordHolder").removeClass("has-error");
            }
        });
    });
})();