define([
    'jquery',
    'swal',
], function ($, swal, ) {
    let jq = $.noConflict();
    let methods = {};

    methods.toArray = function (jsonObject) {
        return jq.parseJSON(jsonObject);
    };

    methods.notify = function (title, message) {
        swal({
            title: title,
            text: message,
            button: true
        });
    };
    
    methods.url_segments = function () {
        return (window.location.pathname).substr(1).split('/');
    };

    return methods;
});