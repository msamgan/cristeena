requirejs.config({
    baseUrl: '/js/',
    paths: {
        jquery: '../assets/vendor/jquery/jquery.min',
        jq_validations: 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min',
        swal: 'https://unpkg.com/sweetalert/dist/sweetalert.min',
        methods: 'methods',
        login_submit: 'Auth/login'
    }
});


requirejs([
    'login_submit'
],function () { });
