define([
    'jquery',
    'jq_validations',
    'methods',
    'jq_form'
], function ($, validation, methods) {
    let profile_form = $('#profile-form');

    if ($("meta[name=module]").attr('content') === 'profile') {
        $.get('/api/users/view/' + profile_form.data('slug'), function (response) {
            response = methods.toArray(response);
            if (response['status']) {
                $('#email-label').html(response['user']['email']);
                $('#name').val(response['user']['name']);
                if (!$.isEmptyObject(response['user']['profile_image'])) {
                    $('#preview_image').attr(
                        'src',
                        '/img/profile/' + response['user']['profile_image']
                    );
                }
            } else {
                methods.notify(
                    response['title'],
                    response['message'],
                    'error'
                );
                methods.redirect(
                    3,
                    '/users'
                );
            }
        });

        profile_form.validate({
            ignore: ":hidden",
            errorClass: 'has-error',
            validClass: 'has-success',
            highlight: function(element, errorClass, validClass) {
                $(element).parent().removeClass(validClass).addClass(errorClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parent().removeClass(errorClass).addClass(validClass);
            }
        });

        profile_form.ajaxForm(function(response) {
            response = methods.toArray(response);
            if (response['status']) {
                methods.notify(response['title'], response['message'], 'success');
                profile_form.attr('data-slug', response['user']['slug']);
                $('#nav-user-name').html($('#name').val());
                if (!$.isEmptyObject(response['user']['profile_image'])) {
                    $('#nav-user-profile-image').attr(
                        'src',
                        '/img/profile/' + response['user']['profile_image']
                    );
                }
            } else {
                methods.notify(
                    response['title'],
                    response['message'],
                    'error'
                );
            }
        });
    }
});
