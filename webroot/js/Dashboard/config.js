requirejs.config({
    baseUrl: '/js/',
    paths: {
        jquery: '../assets/vendor/jquery/jquery.min',
        bootstrap: '../assets/vendor/bootstrap/js/bootstrap.min',
        klorofil: '../assets/scripts/klorofil-common'
    },
    shim: {
        bootstrap : {
            deps : [ 'jquery'],
            exports: 'bootstrap'
        },
    }
});


requirejs([
    'jquery',
    'bootstrap',
    'klorofil'
],function ($) {
    console.log('all Dashboard dependencies injected.');
    let module = $("meta[name=module]").attr('content');

    let dashboard_menu = $('#'+ module +'-menu');
    dashboard_menu.removeClass('collapsed')
    dashboard_menu.addClass('active')
});
