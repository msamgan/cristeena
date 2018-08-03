define([
    'jquery',
    'jq_validations',
    'methods'
], function ($, validation, methods) {
    const action_url = '/api/login';
    let login_form = $( "#login-form" );
    login_form.validate({
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
            let login_btn = $('#login-btn');
            login_btn.attr('disabled', 'disabled');
            login_btn.html('LOADING....');
            $.post( action_url, login_form.serialize() ).done(function (response) {
                response = methods.toArray(response);
                if (response['status']) {
                    methods.notify(response['title'], response['message'], 'success');
                    login_btn.html('REDIRECTING..');
                    methods.redirect(
                        2,
                        '/dashboard'
                    );
                } else {
                    methods.notify(response['title'], response['message'], 'error');
                    login_btn.removeAttr('disabled');
                    login_btn.html('LOGIN');
                }
            });

            return false; // required to block normal submit since you used ajax
        }
    });
});
