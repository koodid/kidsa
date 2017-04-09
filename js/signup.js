(function initFormListeners() {
    if (typeof jQuery == 'undefined') {
        // jQuery is not loaded
        setTimeout(initFormListeners, 100);
        return;
    }
    $(document).ready(function () {
        $("#set_username").on("input", function () {
            console.log("#username changed: ", $(this).val());
            // possibly validate that username is not in use
        });

        $("#set_password").on("input", function () {
            if ($("#set_confirmpassword").val() !== $(this).val()) {
                $("#confirmpasswordHolder").addClass("has-error");
            } else {
                $("#confirmpasswordHolder").removeClass("has-error");
            }
        });

        $("#set_confirmpassword").on("input", function () {
            if ($("#set_password").val() !== $(this).val()) {
                $("#confirmpasswordHolder").addClass("has-error");
            } else {
                $("#confirmpasswordHolder").removeClass("has-error");
            }
        });
    });
})();