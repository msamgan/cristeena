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
    $('#' + $("meta[name=module]").attr('content') + '-menu')
        .removeClass('collapsed')
        .addClass('active');
});
