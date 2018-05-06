define([
    'jquery',
    'methods'
], function ($, methods) {
    let change_password_form = $('#change-password-form');

    const action_url = '/api/users/change-password/';
    change_password_form.validate({
        ignore: ":hidden",
        rules: {
            password: "required",
            confirm_password: {
                equalTo: "#new-password"
            }
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
            $.post( action_url, change_password_form.serialize() ).done(function (response) {
                response = methods.toArray(response);
                if (response['status']) {
                    methods.notify(response['title'], response['message'], 'success');
                    $('#password').val('');
                    $('#new-password').val('');
                    $('#confirm-password').val('');
                } else {
                    methods.notify(response['title'], response['message'], 'error');
                }
            });
            return false; // required to block normal submit since you used ajax
        }
    });
});