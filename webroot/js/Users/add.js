define([
    'jquery',
    'jq_validations',
    'methods'
], function ($, validation, methods) {
    const action_url = '/api/users/add';
    $( "#add-user-form" ).validate({
        ignore: ":hidden",
        rules: {
            email: {
                email: true
            },
            password: "required",
            confirm_password: {
                equalTo: "#password"
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
            $.post( action_url, $( "#add-user-form" ).serialize() ).done(function (response) {
                response = methods.toArray(response);
                if (response['status']) {
                    methods.notify(response['title'], response['message'], 'success');
                    setTimeout(function () {
                        window.location.href = '/admin/users';
                    }, 3000)
                } else {
                    methods.notify(response['title'], response['message'], 'error');
                }
            });
            return false; // required to block normal submit since you used ajax
        }
    });
});
