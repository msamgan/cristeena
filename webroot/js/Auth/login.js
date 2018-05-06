define([
    'jquery',
    'jq_validations',
    'methods'
], function ($, validation, methods) {
    const action_url = '/api/login';
    $( "#login-form" ).validate({
        ignore: ":hidden",
        rules: {
            email: {
                email: true
            },
        },
        errorClass: 'has-error',
        validClass: 'has-success',
        highlight: function(element, errorClass, validClass) {
            $(element).parent().removeClass(validClass).addClass(errorClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parent().removeClass(errorClass).addClass(validClass);
        },
        submitHandler: function (form) {
            $.post( action_url, $( "#login-form" ).serialize() ).done(function (response) {
                response = methods.toArray(response);
                if (response['status']) {
                    methods.notify(response['title'], response['message'], 'success');
                    setTimeout(function () {
                        window.location.href = '/dashboard';
                    }, 3000)
                } else {
                    methods.notify(response['title'], response['message'], 'error');
                }
            });
            return false; // required to block normal submit since you used ajax
        }
    });
});
