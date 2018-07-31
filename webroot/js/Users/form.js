define([
    'jquery',
    'jq_validations',
    'methods',
    'jq_form'
], function ($, validation, methods) {
    let user_form = $( "#user-form" );
    user_form.validate({
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
    });

    user_form.ajaxForm(function(response) {
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


    /**
     * fill edit form data.
     */
    if (user_form.data('role') == 'edit') {
        $.get('/api/users/view/' + user_form.data('slug'),function (response) {
                response = methods.toArray(response);
                if (response['status']) {
                    $('#email').val(response['user']['email']);
                    $('#name').val(response['user']['name']);
                } else {
                    methods.notify(response['title'], response['message'], 'error');
                    setTimeout(function () {
                        window.location.href = '/admin/users';
                    }, 3000)
                }
            }
        );
    }
});
