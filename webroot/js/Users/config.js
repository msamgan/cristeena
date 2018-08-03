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
    ],function ($) {
        console.log('all Users dependencies injected.');
        let meta = $("meta[name=module]");
        let module = meta.attr('content');

        if (module === 'profile' || module ==='settings') {
            return false;
        }

        $('#'+ module +'-menu').removeClass('collapsed').addClass('active');
        $('#'+ module +'-submenu').addClass('in');
        $('#'+ module +'-submenu-' + meta.data('activity')).addClass('active');
    });
});
