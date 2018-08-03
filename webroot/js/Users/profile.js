define([
    'jquery',
    'methods'
], function ($, methods) {
    let profile_form = $('#profile-form');

    if ($("meta[name=module]").attr('content') === 'profile') {
        $.get('/api/users/view/' + profile_form.data('slug'), function (response) {
            response = methods.toArray(response);
            if (response['status']) {
                $('#email-label').html(response['user']['email']);
                $('#name').val(response['user']['name']);
            } else {
                methods.notify(response['title'], response['message'], 'error');
                setTimeout(function () {
                    window.location.href = '/users';
                }, 3000);
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
            },
            submitHandler: function (form) {
                let action_url = '/api/users/edit/' + profile_form.data('slug');
                $.post( action_url, profile_form.serialize() ).done(function (response) {
                    response = methods.toArray(response);
                    if (response['status']) {
                        methods.notify(response['title'], response['message'], 'success');
                        profile_form.attr('data-slug', response['user']['slug']);
                        $('#nav-user-name').html($('#name').val());
                    } else {
                        methods.notify(response['title'], response['message'], 'error');
                    }
                });

                return false; // required to block normal submit since you used ajax
            }
        });
    }
});
