requirejs.config({
    baseUrl: '/js/',
    paths: {
        jquery: '../assets/vendor/jquery/jquery.min',
        bootstrap: '../assets/vendor/bootstrap/js/bootstrap.min',
        klorofil: '../assets/scripts/klorofil-common',
        jq_validations: 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min',
        swal: 'https://unpkg.com/sweetalert/dist/sweetalert.min',
        datatables: 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min',
        methods: 'methods',

        index: 'Users/index',
        add: 'Users/add',
        edit: 'Users/edit',
        delete: 'Users/delete',
        profile: 'Users/profile',
        settings: 'Users/settings'
    },
    shim: {
        bootstrap : {
            deps : [ 'jquery'],
            exports: 'bootstrap'
        },
        datatables: {
            deps : [ 'jquery'],
            exports: 'datatables'
        }
    }
});


requirejs([
    'jquery',
    'methods',
    'bootstrap',
    'klorofil',
    'index',
    'add',
    'edit',
    'delete',
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