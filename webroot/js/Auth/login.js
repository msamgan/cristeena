define([
    'jquery',
    'jq_validations',
    'methods'
], function ($, validation, methods) {
    let loginForm = $("#login-form");
    loginForm.validate({
        ignore: ":hidden",
        rules: {
            email: {
                email: true
            },
        },
        errorClass: 'has-error',
        validClass: 'has-success',
        highlight: function(element, errorClass, validClass) {
            $(element).parent()
                .removeClass(validClass)
                .addClass(errorClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parent()
                .removeClass(errorClass)
                .addClass(validClass);
        },
        submitHandler: function () {
            let loginBtn = $('#login-btn');
            loginBtn.attr('disabled', 'disabled');
            loginBtn.html('LOADING....');
            $.post('/api/login', loginForm.serialize()).done(function (response) {
                response = methods.toArray(response);
                if (response['status']) {
                    methods.notify(
                        response['title'],
                        response['message'],
                        'success'
                    );
                    loginBtn.html('REDIRECTING..');
                    methods.redirect(
                        2,
                        '/dashboard'
                    );
                } else {
                    methods.notify(
                        response['title'],
                        response['message'],
                        'error'
                    );
                    loginBtn.removeAttr('disabled');
                    loginBtn.html('LOGIN');
                }
            });

            return false; // required to block normal submit since you used ajax
        }
    });
});
