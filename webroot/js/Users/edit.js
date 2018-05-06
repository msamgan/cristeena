define([
    'jquery',
    'jq_validations',
    'methods'
], function ($, validation, methods) {
    let slug = $('#edit-user-form').data('slug');
    const action_url = '/api/users/edit/' + slug;

    if (jQuery.type( slug ) !== "undefined") {
        $.get('/api/users/view/' + slug, function (response) {
            response = methods.toArray(response);
            if (response['status']) {
                $('#email').val(response['user']['email'])
                $('#name').val(response['user']['name'])
            } else {
                methods.notify(response['title'], response['message'], 'error');
                setTimeout(function () {
                    window.location.href = '/admin/users';
                }, 3000)
            }
        })
    }

    $( "#edit-user-form" ).validate({
        ignore: ":hidden",
        rules: {
            email: {
                email: true
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
            $.post( action_url, $( "#edit-user-form" ).serialize() ).done(function (response) {
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
