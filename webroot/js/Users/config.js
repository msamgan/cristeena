/**
 * loading common paths before module dependent paths.
 */
requirejs(['/js/common.js'], function () {

    /**
     * Module dependent paths
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
        let meta = $("meta[name=module]");
        let module = meta.attr('content');
        let activity = meta.attr('activity');

        if (activity === 'profile' || activity === 'settings') {
            return false;
        }

        $('#' + module + '-menu')
            .removeClass('collapsed')
            .addClass('active');
        $('#' + module + '-submenu').addClass('in');
        $('#' + module + '-submenu-' + meta.data('activity')).addClass('active');
    });
});
