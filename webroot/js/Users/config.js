requirejs(['/js/common_config.js'], function () {

    /**
     * Module dependent js
     */
    requirejs.config({
        baseUrl: '/js/',
        paths: {
            index: 'Users/index',
            form: 'Users/form',
            profile: 'Users/profile',
            settings: 'Users/settings'
        },
    });

    requirejs([
        'jquery',
        'methods',
        'bootstrap',
        'klorofil',
        'index',
        'form',
        'profile',
        'settings'
    ],function ($, methods) {
        console.log('all Users dependencies injected.');
        let module = 'users';
        let url_segments = methods.url_segments();

        if (url_segments.length == 1 && (url_segments[0] == 'profile' || url_segments[0] == 'settings')) {
            return false;
        }

        let user_menu = $('#'+ module +'-menu');
        user_menu.removeClass('collapsed');
        user_menu.addClass('active');
        $('#'+ module +'-submenu').addClass('in');

        if (url_segments.length > 2) {
            $('#users-submenu-' + url_segments[2]).addClass('active');
        } else {
            $('#'+ module +'-submenu-index').addClass('active');
        }
    });
});
